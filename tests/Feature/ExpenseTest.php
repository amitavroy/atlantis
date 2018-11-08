<?php

namespace Tests\Feature;

use App\Events\Expense\ExpenseAddedEvent;
use App\Expense;
use App\ExpenseType;
use App\Models\Reminder;
use App\Models\RemindEvent;
use App\Services\Expense\ExpenseService;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['name' => 'Amitav Roy']);
    }

    /** @test */
    public function a_guest_cannot_see_expenses()
    {
        $this->get(route('expense.index'))
            ->assertRedirect('/login')
            ->status(302);
    }

    /** @test */
    public function a_user_can_see_expense_index_page()
    {
        $this->actingAs($this->user)
            ->get(route('expense.index'))
            ->assertStatus(200)
            ->assertSee('My Expenses');
    }

    /** @test */
    public function a_user_can_see_his_expenses()
    {
        $desc1 = 'Payment of something';
        $desc2 = 'Payment of many thingd';
        $exp1 = factory(Expense::class)->create(['description' => $desc1]);
        $exp2 = factory(Expense::class)->create(['description' => $desc2]);
        $this->actingAs($this->user)
            ->get(route('expense.index'))
            ->assertSee($desc1)
            ->assertSee($desc2)
            ->assertSee('Amitav Roy');
    }

    /** @test */
    public function a_user_can_get_expense_type_for_his_family()
    {
        $familyUser2 = factory(User::class)->create(['family_id' => 2]);

        factory(ExpenseType::class)->create([
            'name' => 'Bill',
            'family_id' => 1,
        ]);

        factory(ExpenseType::class)->create([
            'name' => 'Family bill',
            'family_id' => 2,
        ]);

        $response = $this->ajaxGetRequest('/api/expenses/categories', $this->user);
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Bill']);

        $response = $this->ajaxGetRequest('/api/expenses/categories', $familyUser2);
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Family bill']);

        $response = $this->ajaxGetRequest('/api/expenses/categories', $familyUser2);
        $response->assertStatus(200)->assertJsonMissing(['name' => 'Bill']);
    }

    /** @test */
    public function a_user_should_not_see_other_family_expenses()
    {
        $otherUser = factory(User::class)->create();
        $category = factory(ExpenseType::class)->create([
            'family_id' => $otherUser->family_id,
            'name' => 'Test',
        ]);

        $this->saveExpense($otherUser, $category);

        $this->actingAs($this->user)
            ->get(route('expense.index'))
            ->assertDontSee('Some expense description');
    }

    /** @test */
    public function a_user_can_save_expense()
    {
        $category = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $response = $this->saveExpense($this->user, $category);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'description' => 'Some expense description',
                'transaction_date' => '2018-07-31',
                'amount' => 465,
                'payment_method' => 'Cash',
                'expense_type_id' => $category->id,
                'family_id' => 1,
            ]);
    }

    /** @test */
    public function user_needs_to_fill_required_fields()
    {
        $this->actingAs($this->user, 'api')
            ->post('/api/expenses', [])
            ->assertSessionHasErrors([
                'description',
                'transaction_date',
                'amount',
                'type',
                'category',
            ]);
    }

    /** @test */
    public function an_event_should_be_fired_when_expense_is_saved()
    {
        $this->expectsEvents(ExpenseAddedEvent::class);

        $category = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $this->saveExpense($this->user, $category);
    }

    /** @test */
    public function expense_has_reminder_id_when_provided()
    {
        $category = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $reminder = factory(Reminder::class)->create();

        $postData = [
            'description' => 'Some expense description',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $category->name,
            'type' => 'Cash',
            'reminder_id' => $reminder->id,
        ];

        $response = $this->saveExpense($this->user, $category, $postData);

        $response = (array) json_decode($response->getContent());

        $this->assertEquals($reminder->id, $response['reminder_id']);
    }

    /** @test */
    public function expense_has_null_reminder_id_when_not_provided()
    {
        $category = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $postData = [
            'description' => 'Some expense description',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $category->name,
            'type' => 'Cash',
        ];

        $response = $this->saveExpense($this->user, $category, $postData);

        $response = (array) json_decode($response->getContent());

        $this->assertEquals(null, $response['reminder_id']);
    }

    /** @test */
    public function a_reminder_payment_sets_event_inactive()
    {
        $category = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $reminder = factory(Reminder::class)->create();

        Artisan::call('reminder:set');

        $postData = [
            'description' => 'Some expense description',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $category->name,
            'type' => 'Cash',
            'reminder_id' => $reminder->id,
        ];

        $this->saveExpense($this->user, $category, $postData);

        $reminderEvent = RemindEvent::where('reminder_id', $reminder->id)->first();

        $this->assertEquals(0, $reminderEvent->is_active);
    }
    
    /** @test */
    public function a_category_filter_shows_only_those_items()
    {
        $categoryA = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $categoryB = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Best',
        ]);

        $this->saveExpense($this->user, $categoryA, [
            'description' => 'Some expense description one',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $categoryA->name,
            'type' => 'Cash'
        ]);

        $this->saveExpense($this->user, $categoryB, [
            'description' => 'Some expense description two',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $categoryB->name,
            'type' => 'Cash'
        ]);

        $expenseService = new ExpenseService;
        $expenseTypes = $expenseService->getUserFamilyExpenseType();
        $conditions = collect(['cat' => 'Test', 'type' => 'Cash']);
        $expense = $expenseService->getFilteredExpenses($conditions, $expenseTypes);

        $data = $expense->toArray()['data'];
        $this->assertEquals(1, count($data));
        $this->assertEquals('Some expense description one', $data[0]['description']);
    }

    /** @test */
    public function a_payment_method_filter_shows_only_those_items()
    {
        $categoryA = factory(ExpenseType::class)->create([
            'family_id' => $this->user->family_id,
            'name' => 'Test',
        ]);

        $this->saveExpense($this->user, $categoryA, [
            'description' => 'Some expense description one',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $categoryA->name,
            'type' => 'Cash'
        ]);

        $this->saveExpense($this->user, $categoryA, [
            'description' => 'Some expense description two',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $categoryA->name,
            'type' => 'Credit Card'
        ]);

        $this->saveExpense($this->user, $categoryA, [
            'description' => 'Some expense description three',
            'transaction_date' => '2018-07-31',
            'amount' => 465,
            'category' => $categoryA->name,
            'type' => 'Credit Card'
        ]);

        $expenseService = new ExpenseService;
        $expenseTypes = $expenseService->getUserFamilyExpenseType();
        $conditions = collect(['cat' => 'Test', 'type' => 'Credit Card']);
        $expense = $expenseService->getFilteredExpenses($conditions, $expenseTypes);

        $data = $expense->toArray()['data'];
        $this->assertEquals(2, count($data));
        $this->assertEquals('Some expense description three', $data[0]['description']);
        $this->assertEquals('Some expense description two', $data[1]['description']);
    }

    private function saveExpense($user, $category, $expenseData = null)
    {
        $postData = $expenseData;

        if ($expenseData === null) {
            $postData = [
                'description' => 'Some expense description',
                'transaction_date' => '2018-07-31',
                'amount' => 465,
                'category' => $category->name,
                'type' => 'Cash'
            ];
        }

        return $this->actingAs($user, 'api')
            ->post('/api/expenses', $postData);
    }
}
