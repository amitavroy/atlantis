<?php

namespace Tests\Feature;

use App\Models\Reminder;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ReminderEventsTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
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

        $response = $this->actingAs($this->user, 'api')
            ->json('GET', route('reminder-events.list'));

        $responseArr = (array)json_decode($response->getContent());

        $this->assertEquals($reminder->id, $responseArr[0]->reminder_id);
    }

    /** @test */
    public function a_user_can_see_reminders_within_range()
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

        $response = $this->actingAs($this->user, 'api')
            ->json('GET', route('reminder-events.list'));

        $responseArr = (array)json_decode($response->getContent());

        $this->assertEquals(2, count($responseArr));
        $this->assertEquals($reminder2->title, $responseArr[0]->title);
        $this->assertEquals($reminder1->title, $responseArr[1]->title);
    }
}
