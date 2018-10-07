<?php

namespace Tests\Unit;

use App\Expense;
use App\ExpenseType;
use App\Services\Expense\DailyExpenseSummary;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteSummaryTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create([
            'name' => 'Amitav Roy',
        ]);
    }

    /** @test */
    public function summary_will_have_expenses_if_made_that_day()
    {
        $expense = factory(Expense::class)->create([
            'transaction_date' => Carbon::today(),
        ]);

        $summary = new DailyExpenseSummary();
        $data = $summary->handle();

        $this->assertEquals($data['today_total'], $expense->amount);
        $this->assertEquals($data['category_wise'][$expense->category->name], $expense->amount);
        $this->assertEquals($data['payment_method_wise'][$expense->payment_method], $expense->amount);
        $this->assertEquals($data['descriptions'][0], $expense->description);
    }

    /** @test */
    public function sum_of_all_expenses_are_visible()
    {
        factory(Expense::class)->create([
            'transaction_date' => Carbon::today(),
            'amount' => 100,
        ]);

        factory(Expense::class)->create([
            'transaction_date' => Carbon::today(),
            'amount' => 1,
        ]);

        factory(Expense::class)->create([
            'transaction_date' => Carbon::today(),
            'amount' => 10,
        ]);

        $summary = new DailyExpenseSummary();
        $data = $summary->handle();

        $this->assertEquals(111, $data['today_total']);
    }

    /** @test */
    public function sum_of_only_current_date_is_visible()
    {
        factory(Expense::class)->create([
            'transaction_date' => Carbon::today(),
            'amount' => 100,
        ]);

        factory(Expense::class)->create([
            'transaction_date' => Carbon::yesterday(),
            'amount' => 1,
        ]);

        factory(Expense::class)->create([
            'transaction_date' => Carbon::today(),
            'amount' => 10,
        ]);

        $summary = new DailyExpenseSummary();
        $data = $summary->handle();

        $this->assertEquals(110, $data['today_total']);
    }
    
    /** @test */
    public function when_no_expense_data_is_blank()
    {
        factory(Expense::class)->create([
            'transaction_date' => Carbon::yesterday(),
            'amount' => 1,
        ]);

        $summary = new DailyExpenseSummary();
        $data = $summary->handle();

        $this->assertEquals(0, $data['today_total']);
    }
}
