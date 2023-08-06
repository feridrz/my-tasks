<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test for user registration.
     *
     * @return void
     */
    public function test_register()
    {
        $data = [
            "name" => "testUser",
            "email" => "testuser4@example.com",
            "password" => "password",
            "password_confirmation" => "password",
        ];

        $response = $this->postJson('api/register', $data);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test for user login.
     *
     * @return void
     */
    public function test_login()
    {
        $data = [
            "email" => "testuser4@example.com",
            "password" => "password",
        ];

        $response = $this->postJson('api/login', $data);

        $response->assertStatus(200);
    }
}
