<?php

namespace App\Listeners\Expense;

use App\Events\Expense\ExpenseAddedEvent;
use App\Models\RemindEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ClearReminder implements ShouldQueue
{
    public function handle(ExpenseAddedEvent $event)
    {
        RemindEvent::where('reminder_id', $event->expense['reminder_id'])->update([
            'is_active' => 0
        ]);

        Cache::forget('dashStats.' . Auth::user()->family_id);
    }
}
