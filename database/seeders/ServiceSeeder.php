<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::updateOrCreate(
            ['name' => 'Biasa'],
            [
                'description' => 'Cuci mobil biasa',
                'price' => 50000,
                'duration_minutes' => 30
            ]
        );
        Service::updateOrCreate(
            ['name' => 'Special'],
            [
                'description' => 'Cuci mobil special',
                'price' => 100000,
                'duration_minutes' => 60
            ]
        );
    }
}
