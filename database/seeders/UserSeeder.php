<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'telegram_id' => 123456789,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'phone' => '0123456789',
            'photo_url' => 'https://via.placeholder.com/150'
        ]);

        User::create([
            'telegram_id' => 987654321,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'username' => 'janesmith',
            'phone' => '0987654321',
            'photo_url' => 'https://via.placeholder.com/150'
        ]);
    }
}
