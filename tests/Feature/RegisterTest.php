<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_creates_user()
    {
        $userData = [
            'email' => 'testuser@example.com',
            'nickname' => 'TestUser',
            'birthdate' => '1990-01-01',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post(route('register.store'), $userData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('microsec_users', [
            'email' => 'testuser@example.com',
        ]);
    }
}
