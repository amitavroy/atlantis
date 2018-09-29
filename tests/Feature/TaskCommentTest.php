<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskCommentTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_user_can_comment_on_a_task()
    {
        $task = factory(Task::class)->create();

        $postData = [
            'comment' => 'This is a test comment',
            'task_id' => $task->id,
        ];

        $response = $this->actingAs($this->user, 'api')
            ->post(route('task-comment.add'), $postData);

        $response->assertStatus(201)->assertJsonFragment([
            'body' => $postData['comment'],
            'commentable_id' => $task->id,
        ]);
    }

    /** @test */
    public function a_user_needs_to_fill_comment_body()
    {
        $this->actingAs($this->user, 'api')
            ->post(route('task-comment.add'), [])
            ->assertSessionHasErrors([
                'comment',
            ]);
    }

    /** @test */
    public function a_user_gets_error_when_task_is_missing()
    {
        $postData = [
            'comment' => 'This is a test comment',
            'task_id' => 99,
        ];

        $this->actingAs($this->user, 'api')
            ->post(route('task-comment.add'), $postData)
            ->assertStatus(404);
    }
}
