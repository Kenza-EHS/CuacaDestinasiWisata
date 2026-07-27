<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Location;
use App\Models\WeatherData;
use App\Models\AirQuality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Sapati
        User::create([
            'name' => 'Sapati',
            'username' => 'Sapati',
            'email' => 'sapati@weatherapp.com',
            'password' => Hash::make('LaSapati123'),
            'role' => 'admin',
        ]);

        // 2. Dump Data User Regular
        $users = ['Kenza', 'Costan', 'Hafiz', 'Indra', 'Ekahido'];
        foreach ($users as $name) {
            User::create([
                'name' => $name,
                'username' => strtolower($name),
                'email' => strtolower($name) . '@weatherapp.com',
                'password' => Hash::make('User1234@'),
                'role' => 'user',
            ]);
        }

        // 3. Top 10 KSPN
        $kspns = [
            ['name' => 'Danau Toba', 'city' => 'Samosir', 'province' => 'Sumatera Utara'],
            ['name' => 'Borobudur', 'city' => 'Magelang', 'province' => 'Jawa Tengah'],
            ['name' => 'Mandalika', 'city' => 'Lombok Tengah', 'province' => 'Nusa Tenggara Barat'],
            ['name' => 'Labuan Bajo', 'city' => 'Manggarai Barat', 'province' => 'Nusa Tenggara Timur'],
            ['name' => 'Likupang', 'city' => 'Minahasa Utara', 'province' => 'Sulawesi Utara'],
            ['name' => 'Bangka Belitung', 'city' => 'Tanjung Pandan', 'province' => 'Bangka Belitung'],
            ['name' => 'Candi Prambanan', 'city' => 'Sleman', 'province' => 'DI Yogyakarta'],
            ['name' => 'Gunung Bromo', 'city' => 'Probolinggo', 'province' => 'Jawa Timur'],
            ['name' => 'Wakatobi', 'city' => 'Wakatobi', 'province' => 'Sulawesi Tenggara'],
            ['name' => 'Raja Ampat', 'city' => 'Raja Ampat', 'province' => 'Papua Barat Daya'],
        ];

        foreach ($kspns as $kspn) {
            $loc = Location::create($kspn);

            // Weather Data Dummy (Disertai recorded_at)
            WeatherData::create([
                'location_id' => $loc->id,
                'temperature' => rand(15, 35),
                'humidity'    => rand(40, 90),
                'wind_speed'  => rand(5, 25),
                'condition'   => 'Cerah',
                'recorded_at' => now(), // <-- KUNCI PERBAIKAN DI SINI
            ]);

            // Air Quality Dummy
            // Air Quality Dummy (Sertakan pm25 & recorded_at)
            AirQuality::create([
                'location_id' => $loc->id,
                'aqi'         => rand(20, 80),
                'pm25'        => rand(5, 35), // <-- TAMBAHKAN KOLOM PM25
                'status'      => 'Baik',
                'recorded_at' => now(),
            ]);
        }
    }
}