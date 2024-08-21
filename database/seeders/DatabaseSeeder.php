<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(10)->create(); // Create 10 categories
        Product::factory(50)->create(); // Create 50 products

        User::create([
            'name' => 'Admin',
            'email' => 'rizzlychannel@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
            'balance' => 10000000,
        ]);
    }
}
