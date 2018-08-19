<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseStatsPageTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }
    
    /** @test */
    public function a_guest_cannot_see_stats_page()
    {
        $this->get(route('expense.stats'))
            ->assertStatus(302)
            ->assertRedirect('/login');
    }
}
