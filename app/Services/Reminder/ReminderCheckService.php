<?php

namespace App\Services\Reminder;

use App\Models\Reminder;
use App\Models\RemindEvent;
use Carbon\Carbon;

class ReminderCheckService
{
    public static function check()
    {
        $addDays = config('atlantis.reminder_range');
        $today = now();
        $range = $today->addDays($addDays);

        $reminders = Reminder::where('reminder_date', '<=', $range)
            ->where('repeat', 'monthly')
            ->get();

        $reminderEvents = RemindEvent::where('reminder_at', '<=', $range)
            ->pluck('reminder_id');

        foreach ($reminders as $reminder) {
            if ($reminderEvents->contains($reminder->id)) {
                continue;
            }

            $date = Carbon::parse($reminder->reminder_date);
            $dateSet = Carbon::now();
            $dateSet->day = $date->day;
            $dateSet->hour = '00';
            $dateSet->minute = '00';
            $dateSet->second = '00';

            RemindEvent::create([
                'reminder_id' => $reminder->id,
                'reminder_at' => $dateSet,
                'data' => ['reminder' => $reminder->toArray()]
            ]);
        }
    }
}
