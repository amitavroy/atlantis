<?php

namespace Tests\Unit;

use App\Services\DashboardService;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardServiceTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->actingAs($this->user);
    }

    /** @test */
    public function shows_count_of_total_tasks_not_complete()
    {
        factory(Task::class, 10)->create([
            'is_complete' => 0,
            'user_id' => $this->user->id,
        ]);

        $dashData = (new DashboardService())->getDashboardData();

        $this->assertEquals(10, $dashData['tasks']);
    }

    /** @test */
    public function does_not_consider_completed_count()
    {
        factory(Task::class, 5)->create([
            'is_complete' => 0,
            'user_id' => $this->user->id,
        ]);

        factory(Task::class, 5)->create([
            'is_complete' => 1,
            'user_id' => $this->user->id,
        ]);

        $dashData = (new DashboardService())->getDashboardData();

        $this->assertEquals(5, $dashData['tasks']);

        $this->assertEquals(10, Task::all()->count());
    }
}
