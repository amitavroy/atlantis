<?php

namespace App\Listeners\Tasks;

use App\Comment;
use App\Events\Task\TaskDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskDeletedListner implements ShouldQueue
{
    /**
     * TaskDeletedListner constructor.
     */
    public function __construct()
    {
    }

    /**
     * Handling the event of Task deleted.
     * @param TaskDeletedEvent $event
     */
    public function handle(TaskDeletedEvent $event)
    {
        Comment::where('commentable_id', $event->taskId)
            ->where('commentable_type', 'App\Task')
            ->delete();

        Cache::forget('dashStats.' . Auth::user()->family_id);
    }
}
