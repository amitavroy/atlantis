<?php

namespace App\Console\Commands;

use App\Services\Reminder\ReminderCheckService;
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
        ReminderCheckService::check();
    }
}
