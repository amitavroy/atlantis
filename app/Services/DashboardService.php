<?php

namespace App\Services;

use App\GitProject;
use App\Site;
use App\Task;
use Illuminate\Support\Facades\Auth;
use App\Gallery;

class DashboardService
{
    public function getDashboardData()
    {
        return [
            'tasks' => count($this->getTaskCount()),
            'sites' => count($this->getSitesCount()),
            'galleries' => count($this->getGalleryCount()),
            'git-stars' => $this->getTotalGitStarts(),
        ];
    }

    private function getTaskCount()
    {
        return Task::where('user_id', Auth::user()->id)
            ->where('is_complete', 0)
            ->get();
    }

    private function getSitesCount()
    {
        return Site::orderBy('name', 'asc')->get();
    }

    private function getGalleryCount()
    {
        return Gallery::where('family_id', Auth::user()->family_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    private function getTotalGitStarts()
    {
        return GitProject::all()->sum('stars');
    }
}
