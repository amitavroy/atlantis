<?php

namespace App\Http\Controllers;

use App\Events\Expense\ExpenseAddedEvent;
use App\Expense;
use App\ExpenseType;
use App\Rules\ExpenseCategoryCheck;
use App\Services\Expense\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ExpenseController extends Controller
{
    /**
     * @var ExpenseService
     */
    private $expenseService;

    /**
     * ExpenseController constructor.
     * @param ExpenseService $expenseService
     */
    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    public function index()
    {
        $expenseTypes = $this->expenseService->getUserFamilyExpenseType();

        $expenses = Expense::with('user')
            ->where('family_id', Auth::user()->family_id)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        $viewData = $this->expenseService->expensesForView($expenses, $expenseTypes);

        return view('expense.expense-index')
            ->with('expenseTypes', $expenseTypes)
            ->with('viewData', $viewData)
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

        $categories = $this->expenseService->getUserFamilyExpenseType();

        $expenseCreated = Expense::create([
            'user_id' => Auth::user()->id,
            'family_id' => Auth::user()->family_id,
            'description' => $request->input('description'),
            'transaction_date' => $request->input('transaction_date'),
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('type'),
            'expense_type_id' => $categories->where('name', $request->input('category'))->first()->id,
        ]);

        $expense = Expense::with('user')->where('id', $expenseCreated->id)->get();

        $expense = $this->expenseService->expensesForView($expense, $categories)[0];

        Event::dispatch(new ExpenseAddedEvent($expense));

        return response()->json($expenseCreated, 201);
    }
}
