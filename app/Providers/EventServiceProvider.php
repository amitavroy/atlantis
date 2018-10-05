<?php

namespace App\Providers;

use App\Events\SiteCheck\SiteIsSlowEvent;
use App\Events\Task\TaskCreatedEvent;
use App\Events\Task\TaskDeletedEvent;
use App\Listeners\SiteCheck\SiteIsSlowListner;
use App\Listeners\Tasks\TaskCreatedListner;
use App\Listeners\Tasks\TaskDeletedListner;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SiteIsSlowEvent::class => [
            SiteIsSlowListner::class,
        ],
        TaskCreatedEvent::class => [
            TaskCreatedListner::class,
        ],
        TaskDeletedEvent::class => [
            TaskDeletedListner::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
