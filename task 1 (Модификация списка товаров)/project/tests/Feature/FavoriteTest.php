<?php

namespace Tests\Feature;

use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Services\FavoriteService;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_adds_product_to_favorites_and_returns_200()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $token = $this->postJson('api/login', [
            'email' => $user->email,
            'password' => $password,
        ])->json('data.token');

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson(route('favorites.store', ['product' => $product->id]));

        $response->assertStatus(200);
    }


    public function test_index_favorites()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $token = $this->postJson('api/login', [
            'email' => $user->email,
            'password' => $password,
        ])->json('data.token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('api/favorites');

        $response->assertStatus(200);

    }

}
