<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {

    }

    public function test_index()
    {
        $response = $this->getJson('api/products');

        $response->assertStatus(200);
    }

    public function test_show()
    {

    }
}

