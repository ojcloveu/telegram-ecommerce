<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'user_id' => 1,
            'total_price' => 999.99,
            'status' => 'pending'
        ]);

        Order::create([
            'user_id' => 2,
            'total_price' => 1199.99,
            'status' => 'shipped'
        ]);
    }
}
