<?php

namespace App\Services\Expense;

use App\ExpenseType;
use Illuminate\Support\Facades\Auth;

class ExpenseService
{
    public function getUserFamilyExpenseType()
    {
        return ExpenseType::where('family_id', Auth::user()->family_id)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function expensesForView($expenses, $expenseTypes)
    {
        $collection = collect();

        foreach ($expenses as $expense) {
            $expense['category'] = $expenseTypes->where('id', $expense->expense_type_id)
                ->first()
                ->name;

            $expense['expense_amt'] = number_format($expense->amount, 2, '.', ',');

            $collection->push($expense->toArray());
        }

        return $collection;
    }
}
