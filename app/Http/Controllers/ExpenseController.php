<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('user')
            ->where('family_id', Auth::user()->family_id)
            ->orderBy('transaction_date', 'desc')
            ->paginate(20);

        return view('expense.expense-index')->with('expenses', $expenses);
    }
}
