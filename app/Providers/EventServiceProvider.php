<?php

namespace App\Providers;

use App\Events\Expense\ExpenseAddedEvent;
use App\Events\SiteCheck\SiteIsSlowEvent;
use App\Events\Task\TaskCreatedEvent;
use App\Events\Task\TaskDeletedEvent;
use App\Listeners\Expense\ClearReminder;
use App\Listeners\SiteCheck\SiteIsSlowListner;
use App\Listeners\Tasks\TaskCreatedListner;
use App\Listeners\Tasks\TaskDeletedListner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ExpenseAddedEvent::class => [
            ClearReminder::class,
        ]
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
