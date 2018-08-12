<?php

namespace App\Services;

use App\Site;
use App\Task;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getDashboardData()
    {
        return [
            'tasks' => count($this->getTaskCount()),
            'sites' => count($this->getSitesCount()),
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
}
