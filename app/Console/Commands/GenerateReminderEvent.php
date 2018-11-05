<?php

namespace App\Console\Commands;

use App\Models\Reminder;
use App\Models\RemindEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateReminderEvent extends Command
{
    protected $signature = 'reminder:set';

    protected $description = 'Set reminder events based on reminders entry';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
//        $today = Carbon::parse('2018-11-07');
        $today = now();
        $range = $today->addDays(3);

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
