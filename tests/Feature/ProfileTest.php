<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_user_can_see_own_profile_page()
    {
        $this->actingAs($this->user)
            ->get(route('profile.index'))
            ->assertStatus(200)
            ->assertSee("My profile")
            ->assertSee($this->user->name);
    }

    /** @test */
    public function a_user_can_edit_profile()
    {
        $data = [
            'name' => 'My new name'
        ];

        $this->actingAs($this->user)
            ->post(route('profile.save'), $data);

        $this->actingAs($this->user)
            ->get(route('profile.index'))
            ->assertSee('My new name');
    }

    /** @test */
    public function a_user_needs_to_fill_both_password_fields()
    {
        $response = $this->actingAs($this->user)
            ->post(route('profile.save'), [
                'password' => 'something',
                'name' => 'Amitav Roy',
            ]);

        $response->assertSessionHasErrors(['confirm_password']);
    }

    /** @test */
    public function a_user_can_change_password()
    {
        $response = $this->actingAs($this->user)->post(route('profile.save'), [
            'name' => $this->user->name,
            'password' => 'new_password',
            'confirm_password' => 'new_password'
        ]);

        $response->assertRedirect(route('profile.index'));

        $authAttempt = Auth::attempt([
            'email' => $this->user->email,
            'password' => 'new_password'
        ]);

        $this->assertTrue($authAttempt);
    }
}
