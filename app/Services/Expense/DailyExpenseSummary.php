<?php

namespace App\Services\Expense;

use App\Expense;
use Carbon\Carbon;

class DailyExpenseSummary
{
    public function handle()
    {
        $yesterday = Carbon::yesterday();

        $expenses = Expense::where('expenses.transaction_date', '>', $yesterday)
            ->with('category')
            ->get();

        $cat = [];
        $paymentMethod = [];
        $descriptons = [];
        foreach ($expenses as $expense) {
            if (isset($paymentMethod[$expense->payment_method])) {
                $paymentMethod[$expense->payment_method] = $paymentMethod[$expense->payment_method] + $expense->amount;
            } else {
                $paymentMethod[$expense->payment_method] = $expense->amount;
            }

            if (isset($cat[$expense->category->name])) {
                $cat[$expense->category->name] = $cat[$expense->category->name] + $expense->amount;
            } else {
                $cat[$expense->category->name] = $expense->amount;
            }

            $descriptons[] = $expense->description;
        }

        $data = [
            'today_total' => $expenses->sum('amount'),
            'category_wise' => $cat,
            'payment_method_wise' => $paymentMethod,
            'descriptions' => $descriptons,
        ];

        return $data;
    }
}
