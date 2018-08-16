<?php

namespace Tests\Feature;

use App\Expense;
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
        $this->user = factory(User::class)->create();
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
        $exp1 = factory(Expense::class)->create();
        $exp2 = factory(Expense::class)->create();
        $this->actingAs($this->user)
            ->get(route('expense.index'))
            ->assertSee($exp1->description)
            ->assertSee($exp2->description);
    }
}
