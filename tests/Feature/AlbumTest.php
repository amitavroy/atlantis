<?php

namespace Tests\Feature;

use App\Gallery;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlbumTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_guest_cannot_see_albums_page()
    {
        $this->get(route('gallery.index'))
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_see_albums_page()
    {
        $this->actingAs($this->user)
            ->get(route('gallery.index'))
            ->assertStatus(200)
            ->assertSee('My galleries');
    }

    /** @test */
    public function a_user_can_see_own_galleries()
    {
        $gallery = factory(Gallery::class)->create([
            'user_id' => $this->user->id,
            'family_id' => $this->user->family_id,
            'name' => 'My first gallery',
        ]);

        $this->actingAs($this->user)
            ->get(route('gallery.index'))
            ->assertSee('My first gallery')
            ->assertSee($gallery->description);
    }
}
