<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // For Users
        $userRecords = [];
        foreach (range(1, 50) as $index) {
            $userRecords[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ];
        }
        DB::table('users')->insert($userRecords);

        // For Products
        $productRecords = [];
        foreach (range(1, 1000) as $index) {
            $productRecords[] = [
                'name' => $faker->word,
                'description' => $faker->sentence,
                'category' => $faker->word,
            ];
        }
        DB::table('products')->insert($productRecords);

        // For Favorites
        $favoriteRecords = [];
        foreach (range(1, 200) as $index) {
            $favoriteRecords[] = [
                'user_id' => $faker->numberBetween(1, 50),
                'product_id' => $faker->numberBetween(1, 1000),
            ];
        }
        DB::table('favorites')->insert($favoriteRecords);

        // For Product Images
        $productImageRecords = [];
        foreach (range(1, 1500) as $index) {
            $productImageRecords[] = [
                'product_id' => $faker->numberBetween(1, 1000),
                'image_url' => $faker->imageUrl(),
            ];
        }
        DB::table('product_images')->insert($productImageRecords);
    }
}
