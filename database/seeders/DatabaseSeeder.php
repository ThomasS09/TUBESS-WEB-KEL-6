<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@carwash.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);
        
        // Employee user
        User::create([
            'name' => 'Employee 1',
            'email' => 'employee1@carwash.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'phone' => '081234567891',
        ]);
        
        // Customer user
        $customer = User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '081234567892',
        ]);
        
        // Services
        Service::create([
            'name' => 'Basic Wash',
            'description' => 'Exterior wash and dry',
            'price' => 50000,
            'duration_minutes' => 30,
        ]);
        
        Service::create([
            'name' => 'Premium Wash',
            'description' => 'Exterior wash, dry, and interior vacuum',
            'price' => 80000,
            'duration_minutes' => 45,
        ]);
        
        Service::create([
            'name' => 'Full Detailing',
            'description' => 'Complete interior and exterior detailing',
            'price' => 250000,
            'duration_minutes' => 120,
        ]);
    }
}