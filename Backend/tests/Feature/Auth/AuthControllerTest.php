<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;


class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create([
            'name'      => 'Test User',
            'email'     => 'testuser@example.com',
            'password'  => Hash::make('secret123'),
        ]);
    }

    public function test_login_success_v1()
    {
        $response = $this->postJson('/api/v1/auth/login', [
            'email'     => 'testuser@example.com',
            'password'  => 'secret123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'token',
                     'tokenType',
                     'expiresIn',
                 ]);

        $this->assertNotEmpty($response['token']);
    }

    
    public function test_register_user_success_v1()
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Nuevo Usuario',
            'email' => 'nuevo@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                    'name',
                    'email',
                    'status',
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'nuevo@example.com',
        ]);
    }

}
