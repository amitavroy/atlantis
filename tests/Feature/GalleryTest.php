<?php

namespace Tests\Feature;

use App\Gallery;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_guest_cannot_see_gallery_list()
    {
        $this->get(route('gallery.index'))
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_see_gallery_page()
    {
        $gallery = factory(Gallery::class)->create([
            'user_id' => $this->user->id,
            'family_id' => $this->user->family_id,
            'name' => 'my gallery for test',
        ]);

        $galleryOther = factory(Gallery::class)->create(['name' => 'not my gallery for test',]);

        $this->actingAs($this->user)
            ->get(route('gallery.index'))
            ->assertSee('my gallery for test')
            ->assertDontSee('not my gallery for test')
            ->assertSee('My galleries');
    }
}
