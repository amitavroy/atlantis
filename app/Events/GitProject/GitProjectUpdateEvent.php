<?php

namespace App\Events\GitProject;

use App\GitProject;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GitProjectUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var GitProject
     */
    public $gitProject;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GitProject $gitProject)
    {
        $this->gitProject = $gitProject;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('GitProject');
    }

    public function broadcastAs()
    {
        return 'project.update';
    }
}
