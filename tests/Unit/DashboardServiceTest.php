<?php

namespace Tests\Unit;

use App\GitProject;
use App\Models\Reminder;
use App\Services\DashboardService;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
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

    /** @test */
    public function shows_count_of_stars()
    {
        factory(GitProject::class)->create(['stars' => 10]);
        factory(GitProject::class)->create(['stars' => 5]);

        $dashData = (new DashboardService())->getDashboardData();

        $this->assertEquals(15, $dashData['git-stars']);
    }

    /** @test */
    public function dash_starts_helper_shows_zero_when_no_index()
    {
        factory(GitProject::class)->create(['stars' => 10]);
        factory(GitProject::class)->create(['stars' => 5]);

        $dashData = (new DashboardService())->getDashboardData();
        unset($dashData['git-stars']);

        $stars = dashStats($dashData, 'git-stars');

        $this->assertEquals(0, $stars);
    }

    /** @test */
    public function a_user_can_see_his_reminder_events()
    {
        $reminder = factory(Reminder::class)->create([
            'title' => 'Some reminder for testing',
            'user_id' => $this->user->id,
        ]);

        factory(Reminder::class)->create([
            'title' => 'Some reminder for testing by other user',
            'user_id' => 2,
        ]);

        Artisan::call('reminder:set');

        $dashData = (new DashboardService())->getDashboardData();

        $responseArr = $dashData['reminders'];

        $this->assertEquals($reminder->id, $responseArr->first()->reminder_id);
    }

    /** @test */
    public function a_user_can_see_reminders_within_range_old()
    {
        $configDays = config('atlantis.reminder_range');

        $reminder1 = factory(Reminder::class)->create([
            'title' => 'On the edge',
            'user_id' => $this->user->id,
            'reminder_date' => Carbon::now()->addDays($configDays),
        ]);

        $reminder2 = factory(Reminder::class)->create([
            'title' => 'before the range',
            'user_id' => $this->user->id,
            'reminder_date' => Carbon::now()->addDays($configDays)->subDays(2),
        ]);

        Artisan::call('reminder:set');

        $dashData = (new DashboardService())->getDashboardData();

        $responseArr = $dashData['reminders'];

        $this->assertEquals(2, count($responseArr));
        $this->assertEquals($reminder2->title, $responseArr[0]->data['reminder']['title']);
        $this->assertEquals($reminder1->title, $responseArr[1]->data['reminder']['title']);
    }
}
