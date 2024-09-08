<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ]);

        $loginData = [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('login'), $loginData);

        $response->assertStatus(200);

        $this->assertAuthenticatedAs($user);
    }
}
