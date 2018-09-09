<?php

namespace App\Services\Expense;

use App\Expense;
use App\ExpenseType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function monthWiseExpenseSum($limit = 4)
    {
        return DB::table('expenses')
            ->select(
                DB::raw("MONTHNAME(transaction_date) AS expenseMonth, 
                    SUM(expenses.amount) AS total, 
                    COUNT(1) as trans, 
                    DATE_FORMAT(transaction_date, '%Y-%m') AS ord")
            )
            ->groupBy("ord")
            ->orderBy('ord', 'desc')
            ->limit($limit)
            ->get();
    }

    public function categoryWiseMonthExpense(array $months)
    {
        $query = DB::table('expenses as e')
            ->select(
                DB::raw("DATE_FORMAT(e.transaction_date, '%Y-%m') AS transDate, 
                    et.name AS expCategory, 
                    SUM(e.amount) AS total")
            )
            ->join('expense_types as et', 'et.id', '=', 'e.expense_type_id')
            ->groupBy('transDate')
            ->groupBy('expCategory');

        foreach ($months as $month) {
            $query->orHaving('transDate', $months);
        }

        $query->orderBy('total', 'desc');

        $data = $query->get();

        $monthWise = [];
        foreach ($data as $row) {
            $monthWise[$row->transDate][] = $row;
        }

        return $monthWise;
    }

    public function getFilteredExpenses(Collection $conditions, $expenseTypes)
    {
        $filters = $this->getFilterConditions($conditions, $expenseTypes);

        $expenses = Expense::with(['user', 'category']);

        foreach ($filters as $key => $value) {
            $expenses->where($key, $value);
        }

        $expenses->where('family_id', Auth::user()->family_id)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc');

        $expenses = $expenses->paginate(20);

        return $expenses;
    }

    public function getFilterConditions(Collection $conditions, $expenseTypes)
    {
        $filters = [];

        if ($conditions->has('cat') && $conditions->get('cat') != null) {
            $category = $expenseTypes->filter(function ($expense) use ($conditions) {
                return $expense->name === $conditions->get('cat');
            });

            $filters['expense_type_id'] = ($category->first()) ? $category->first()->id : null;
        }

        if ($conditions->has('user') && $conditions->get('user') != null) {
            $filters['user_id'] = $conditions->get('user');
        }

        if ($conditions->has('type') && $conditions->get('type') != null) {
            $filters['payment_method'] = ucwords($conditions->get('type'));
        }

        return $filters;
    }
}
