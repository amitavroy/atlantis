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
}
