<?php

namespace Tests\Feature;

use App\Expense;
use App\ExpenseType;
use App\User;
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
            ->status(304);
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
    public function a_user_can_save_expense()
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
            'type' => 'Cash'
        ];

        $this->actingAs($this->user, 'api')
            ->post('/api/expenses', $postData)
            ->assertStatus(201)
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
}
