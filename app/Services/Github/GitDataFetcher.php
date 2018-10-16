<?php

namespace App\Services\Github;

use App\Events\GitProject\GitProjectUpdateEvent;
use App\GitProject;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Event;

class GitDataFetcher
{
    private $api;
    private $auth;

    /**
     * GitDataFetcher constructor.
     */
    public function __construct()
    {
        $clientId = config('atlantis.git_client');
        $clientSec = config('atlantis.git_secret');
        $this->api = "https://api.github.com/repos/amitavroy/tranvas";
        $this->auth = "?clientid={$clientId}&client_secret={$clientSec}";

        $this->client = new Client();
    }

    public function fetchGitProjectData()
    {
        $projects = GitProject::all();

        $data = collect();

        $projects->each(function ($project) use ($data) {
            $data->push($this->getDataFromGithub($project->project_url));
        });

        return $data;
    }

    private function getDataFromGithub($projectUrl)
    {
        $url = "https://api.github.com/repos/{$projectUrl}";
        $response = $this->client->request('GET', $url, ['stream' => true]);

        $body = $response->getBody();
        $output = '';

        while (!$body->eof()) {
            $output .= $body->read(1024);
        }

        $project = json_decode($output, true);
        unset($project['owner']);

        $gitProject = GitProject::where('project_url', $projectUrl)
            ->where('sticky', '!=', null)
            ->first();

        if (!$gitProject) {
            return null;
        }

        $gitProject->meta = $project;
        $gitProject->stars = $project['watchers'];
        $gitProject->issues = $project['open_issues'];
        $gitProject->save();

        Event::dispatch(new GitProjectUpdateEvent($gitProject));

        return $project;
    }
}
