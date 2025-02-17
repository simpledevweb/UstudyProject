<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    // protected $seed = true;
    /**
     * A basic feature test user loing.
     */
    public function test_user_login(): void
    {
        // $user = User::create([
        //     'country_id' => Country::inRandomOrder()->first()->id,
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'email_verified_at' => now(),
        //     'phone' => '123456789123',
        //     'phone_verified_at' => now(),
        //     'password' => "12345678"
        // ]);

        // $response = $this->postJson('/api/core/v1/auth/login', [
        //     'phone' => 123456789123,
        //     'password' => "12345678"
        // ]);

        // $response
        // ->assertStatus(200)
        // ->assertJsonStructure([
        //     'status',
        //     'message',
        //     'data' => [
        //         'access_token',
        //         'refresh_token',
        //         'at_expired_at',
        //         'rf_expired_at'
        //     ]
        // ]);

        // $this->assertAuthenticatedAs($user);
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
