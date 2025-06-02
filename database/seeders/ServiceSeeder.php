<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Basic Service',
                'description' => 'Pemeriksaan rutin dan perawatan dasar kendaraan',
                'price' => 500000,
                'duration_minutes' => 60
            ],
            [
                'name' => 'Full Service',
                'description' => 'Pemeriksaan menyeluruh dan perawatan lengkap',
                'price' => 1000000,
                'duration_minutes' => 120
            ],
            [
                'name' => 'Quick Service',
                'description' => 'Pemeriksaan cepat dan perbaikan ringan',
                'price' => 300000,
                'duration_minutes' => 30
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
