<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Check if admin already exists
        if (!User::where('email', 'admin@autowash.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@autowash.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '081234567890'
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}