<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;


class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_token_on_successful_login()
    {
        $user = User::factory()->create([
           'email' => 'sample@test.com',
           'password' => bcrypt('sample123'),
        ]);


        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
               "data" => [
                   'id',
                   'name',
                   'email',
                   'token'
               ],
            ]);

        $this->assertAuthenticated();
    }

    /** @test */
    public function it_returns_an_error_response_on_failed_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        $payload = [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->postJson('/api/login', $payload, [
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJson([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Invalid credentials',
            ]);
    }

}
