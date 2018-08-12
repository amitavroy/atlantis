<?php

namespace App\Listeners\SiteCheck;

use App\Events\SiteCheck\SiteIsSlowEvent;
use App\Mail\SiteCheck\SiteIsSlowMail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SiteIsSlowListner implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SiteIsSlowEvent $event)
    {
        Mail::to(User::find(1))->send(new SiteIsSlowMail($event->site));
    }
}
