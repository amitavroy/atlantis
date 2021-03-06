<?php

namespace App\Console;

use App\Console\Commands\CheckSite;
use App\Console\Commands\DailyApplicationSummary;
use App\Console\Commands\GenerateReminderEvent;
use App\Console\Commands\SiteCheckDataClear;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Amitav\Backup\Command\BackupDatabase;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CheckSite::class,
        SiteCheckDataClear::class,
        DailyApplicationSummary::class,
        GenerateReminderEvent::class,
        BackupDatabase::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('site:check')
            ->everyMinute();

        $schedule->command('site:clear-data')
            ->everyThirtyMinutes();

        $schedule->command('site:summary')
            ->timezone('Asia/Kolkata')
            ->at('22:00');

        $schedule->command('site:gitcheck')
            ->everyFifteenMinutes();

        $schedule->command('reminder:set')
            ->daily();

        $schedule->command('backup:database')
            ->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
