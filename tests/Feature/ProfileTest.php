<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_profile_screen_can_be_rendered()
    {
        $response = $this->get('/profile');

        $response->assertStatus(302);
    }

    public function test_profile_has_been_update()
    {
        $user = User::factory()->create();

        $response = $this->post('/create-profile', [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '12345678',
            'address'=> 'Indonesia'
        ]);

        $response->assertRedirect();
    }
}
