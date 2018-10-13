<?php

namespace App\Console\Commands;

use App\Services\Github\GitDataFetcher;
use Illuminate\Console\Command;

class GitHubCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:gitcheck';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will fetch data from Github and update.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param GitDataFetcher $gitDataFetcher
     * @return mixed
     */
    public function handle(GitDataFetcher $gitDataFetcher)
    {
        $gitDataFetcher->fetchGitProjectData();
    }
}
