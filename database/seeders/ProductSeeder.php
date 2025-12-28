<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create sample products
        Product::create([
            'owner_id' => 1,
            'title' => 'Mountain Bike',
            'description' => 'A sturdy mountain bike suitable for off-road trails.',
            'category' => 'Bicycles',
            'condition' => 'good',
            'price_per_day' => 15.00,
            'location' => 'San Francisco, CA',
            'status' => 'active',
        ]);

        Product::create([
            'owner_id' => 1,
            'title' => 'Camping Tent',
            'description' => '4-person waterproof tent, easy setup.',
            'category' => 'Camping',
            'condition' => 'excellent',
            'price_per_day' => 12.50,
            'location' => 'Oakland, CA',
            'status' => 'active',
        ]);

        Product::create([
            'owner_id' => 1,
            'title' => 'Cordless Drill',
            'description' => '18V cordless drill with two batteries.',
            'category' => 'Tools',
            'condition' => 'good',
            'price_per_day' => 8.00,
            'location' => 'Berkeley, CA',
            'status' => 'active',
        ]);
    }
}
