<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthSanctumTest extends TestCase
{
    use RefreshDatabase; // Очищает БД перед каждым тестом

    /** @test */
    public function a_user_can_login()
    {
        // Создаём пользователя
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Отправляем запрос на вход
        $response = $this->postJson('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure(['user', 'token']);
    }
}