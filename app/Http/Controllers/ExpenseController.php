<?php

namespace App\Http\Controllers;

use App\Events\Expense\ExpenseAddedEvent;
use App\Expense;
use App\Rules\ExpenseCategoryCheck;
use App\Services\Expense\ExpenseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

    public function index(Request $request)
    {
        $expenseTypes = $this->expenseService->getUserFamilyExpenseType();

        $conditions = collect($request->all());

        $expenses = $this->expenseService->getFilteredExpenses($conditions, $expenseTypes);

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

        Cache::forget('expStats.' . Auth::user()->family_id);

        return response()->json($expenseCreated, 201);
    }

    public function stats(ExpenseService $expService)
    {
        $stats = Cache::rememberForever('expStats.' . Auth::user()->family_id, function () use ($expService) {

            $months = [
                Carbon::now()->format('Y-m'),
                Carbon::now()->subMonth(1)->format('Y-m'),
                Carbon::now()->subMonth(2)->format('Y-m'),
            ];

            return [
                'month-wise' => $expService->monthWiseExpenseSum(),
                'category-wise' => $expService->categoryWiseMonthExpense($months),
                'method-wise' => $expService->paymentMethodsWiseSum(),
            ];
        });

        return view('expense.expense-stats')
            ->with('stats', $stats);
    }
}
