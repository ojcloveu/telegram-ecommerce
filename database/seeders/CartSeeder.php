<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::create([
            'user_id' => 1,
            'product_id' => 1,
            'quantity' => 1
        ]);

        Cart::create([
            'user_id' => 2,
            'product_id' => 2,
            'quantity' => 2
        ]);
    }
}
