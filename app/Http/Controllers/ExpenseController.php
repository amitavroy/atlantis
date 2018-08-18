<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseType;
use App\Rules\ExpenseCategoryCheck;
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'transaction_date' => 'required|date_format:Y-m-d',
            'amount' => 'required',
            'type' => ['required', function ($attribute, $value, $fail) {
                $allowed = ['Cash', 'Credit Card', 'Net Banking'];
                if (!in_array($value, $allowed)) {
                    return $fail($attribute . ' is invalid');
                }
            }],
            'category' => ['required', new ExpenseCategoryCheck]
        ]);

        $categories = ExpenseType::where('family_id', Auth::user()->family_id)
            ->get();

        $expense = Expense::create([
            'user_id' => Auth::user()->id,
            'family_id' => Auth::user()->family_id,
            'description' => $request->input('description'),
            'transaction_date' => $request->input('transaction_date'),
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('type'),
            'expense_type_id' => $categories->where('name', $request->input('category'))->first()->id,
        ]);

        return response()->json($expense, 201);
    }
}
