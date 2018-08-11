<?php

namespace Tests\Feature;

use App\Events\Task\TaskCreatedEvent;
use App\Events\Task\TaskDeletedEvent;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function guest_cannot_see_tasks()
    {
        $this->get(route('task.index'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_see_tasks()
    {
        $task = factory(Task::class)->create([
            'user_id' => $this->user->id,
            'is_complete' => 0
        ]);

        $this->actingAs($this->user)
            ->get(route('task.index'))
            ->assertSee($task->description);
    }

    /** @test */
    public function user_can_see_own_tasks()
    {
        $task = factory(Task::class)->create([
            'user_id' => 2,
            'is_complete' => 0
        ]);

        $this->actingAs($this->user)
            ->get(route('task.index'))
            ->assertDontSee($task->description);
    }

    /** @test */
    public function a_guest_cannot_create_task()
    {
        $this->get(route('task.add'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_create_task()
    {
        $this->actingAs($this->user)
            ->get(route('task.add'))
            ->assertStatus(200);

        $postData = ['description' => 'My task'];
        $this->actingAs($this->user)
            ->post(route('task.save'), $postData);

        $this->actingAs($this->user)
            ->get(route('task.index'))
            ->assertSee('My task');
    }

    /** @test */
    public function an_event_is_fired_when_task_is_created()
    {
        $this->expectsEvents(TaskCreatedEvent::class);

        $postData = ['description' => 'My task'];

        $this->actingAs($this->user)
            ->post(route('task.save'), $postData);
    }

    /** @test */
    public function an_event_is_fired_when_task_is_deleted()
    {
        $this->expectsEvents(TaskDeletedEvent::class);

        $task = factory(Task::class)->create();

        $this->actingAs($this->user, 'api')
            ->post(route('task.delete'), [
                'task_id' => $task->id,
            ]);
    }

    /** @test */
    public function a_description_for_task_is_required()
    {
        $this->actingAs($this->user)
            ->post(route('task.save'), [])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_delete_task_his_own_task()
    {
        $task = factory(Task::class)->create();

        $this->actingAs($this->user, 'api')
            ->post(route('task.delete'), [
                'task_id' => $task->id,
            ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_cannot_delete_others_task()
    {
        $task = factory(Task::class)->create([
            'user_id' => 2,
        ]);

        $this->actingAs($this->user, 'api')
            ->post(route('task.delete'), [
                'task_id' => $task->id,
            ])
            ->assertStatus(401);
    }
}
