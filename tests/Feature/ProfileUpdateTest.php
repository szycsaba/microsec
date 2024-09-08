<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile()
    {
        $user = User::factory()->create([
            'nickname' => 'OldNickname',
            'birthdate' => '1990-01-01',
            'password' => 'password123',
        ]);

        $this->actingAs($user);

        $updateData = [
            'nickname' => 'NewNickname',
            'birthdate' => '1995-05-05',
            'password' => 'newpassword123',
        ];

        $response = $this->post(route('profile.update'), $updateData);

        $this->assertDatabaseHas('microsec_users', [
            'id' => $user->id,
            'nickname' => 'NewNickname',
            'birthdate' => '1995-05-05',
        ]);

        $response->assertStatus(200);
    }
}
