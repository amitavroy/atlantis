<?php

namespace Tests\Feature;

use App\GitProject;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GithubPageTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_logged_in_user_can_see_github_projects()
    {
        $project1 = factory(GitProject::class)->create();
        $this->actingAs($this->user)
            ->get(route('github.list'))
            ->assertSee($project1->project_url)
            ->assertStatus(200);
    }
}
