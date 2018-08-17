<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenseTypes = ExpenseType::where('family_id', Auth::user()
            ->family_id)
            ->get();

        $expenses = Expense::with('user')
            ->where('family_id', Auth::user()->family_id)
            ->orderBy('transaction_date', 'desc')
            ->paginate(20);

        return view('expense.expense-index')
            ->with('expenseTypes', $expenseTypes)
            ->with('expenses', $expenses);
    }
}
