<?php

namespace Tests\Feature;

use App\Models\Reminder;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemindersTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['name' => 'Jhon Doe']);
    }

    /** @test */
    public function a_user_can_see_own_reminders_only()
    {
        $myReminder = factory(Reminder::class)->create([
            'user_id' => $this->user->id,
            'title' => 'My own reminder',
        ]);

        $otherReminder = factory(Reminder::class)->create([
            'user_id' => 2,
            'title' => 'Some other reminder',
        ]);

        $this->actingAs($this->user)
            ->get(route('reminder.index'))
            ->assertStatus(200)
            ->assertSee($myReminder->title)
            ->assertDontSee($otherReminder->title);
    }
}
