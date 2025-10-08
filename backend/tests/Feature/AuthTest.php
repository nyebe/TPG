<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_and_login()
    {
        $response = $this->post('/register', [
            'first_name' => 'Jane',
            'middle_name' => 'Q',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/')->assertSessionHas('status', 'Registration successful!');

        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);

        // Logout first
        $this->post('/logout');

        // Login
        $login = $this->post('/login', [
            'email' => 'jane@example.com',
            'password' => 'password123',
        ]);

        $login->assertRedirect('/')->assertSessionHas('status', 'Login successful!');
    }
}
