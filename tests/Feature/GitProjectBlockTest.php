<?php

namespace Tests\Feature;

use App\GitProject;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GitProjectBlockTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_guest_cannot_see_project_status_api()
    {
        $response = $this->json('GET', route('gitproject.list'));
        $response->assertStatus(401);
    }

    /** @test */
    public function a_logged_in_user_can_see_results()
    {
        $sticky = factory(GitProject::class)->create(['sticky' => now()]);
        factory(GitProject::class)->create();

        $response = $this->actingAs($this->user, 'api')
            ->json('GET', route('gitproject.list'))
            ->assertStatus(200);

        $data = json_decode($response->getContent());

        $this->assertEquals(1, count($data));
        $this->assertEquals($sticky->project_url, $data[0]->project_url);
    }
}
