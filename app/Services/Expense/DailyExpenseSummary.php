<?php

namespace App\Services\Expense;

use App\Expense;
use Carbon\Carbon;

class DailyExpenseSummary
{
    public function handle()
    {
        $yesterday = Carbon::yesterday();

        $expenses = Expense::where('created_at', '>', $yesterday)->get();

        $cat = [];
        foreach ($expenses as $expense) {
            if (isset($cat[$expense->payment_method])) {
                $cat[$expense->payment_method] = $cat[$expense->payment_method] + $expense->amount;
            } else {
                $cat[$expense->payment_method] = $expense->amount;
            }
        }

        $data = [
            'today_total' => $expenses->sum('amount'),
            'category_wise' => $cat,
        ];

        return $data;
    }
}
