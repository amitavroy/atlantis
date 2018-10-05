<?php

namespace App\Listeners\Tasks;

use App\Events\Task\TaskCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskCreatedListner implements ShouldQueue
{
    public function handle(TaskCreatedEvent $event)
    {
        Cache::forget('dashStats.' . Auth::user()->family_id);
    }
}
