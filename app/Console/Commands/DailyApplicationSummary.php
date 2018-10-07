<?php

namespace App\Console\Commands;

use App\Mail\ApplicationSummaryMail;
use App\Services\Expense\DailyExpenseSummary;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailyApplicationSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a summary of the application activity';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(DailyExpenseSummary $dailyExpenseSummary)
    {
        $data = $dailyExpenseSummary->handle();
        Mail::to(User::find(1))->send(new ApplicationSummaryMail($data));
    }
}
