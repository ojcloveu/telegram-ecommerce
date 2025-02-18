<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'iPhone 15 Pro',
            'description' => 'Latest Apple iPhone with A17 chip',
            'price' => 999.99,
            'image' => 'https://via.placeholder.com/150',
            'color' => 'Blue Titanium',
            'stock' => 10
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S24 Ultra',
            'description' => 'Samsung flagship phone with powerful camera',
            'price' => 1199.99,
            'image' => 'https://via.placeholder.com/150',
            'color' => 'Phantom Black',
            'stock' => 15
        ]);
    }
}
