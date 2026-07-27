<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KspnSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan nama KSPN di bawah ini SAMA PERSIS dengan yang ada di database kamu
        $foto_kspn = [
            'Danau Toba' => ['region' => 'Sumatera Utara', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiHSMsYZdG0LPu0xQL_F2q-n6MumKvYVzDPDg_qbzJVQ&s=10'],
            'Tanjung Kelayang' => ['region' => 'Sumatera Selatan', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRT0MKdIIQALn04aQ_rdT2XoZ_6Ze4DKiiyCSDw-1vh-Q&s=10'],
            'Tanjung Lesung' => ['region' => 'Jawa Barat', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZ2JgYo93eOh0uJsZrAqIuKKWq11LnlDC0X8eQHQvxzw&s=10'],
            'Kepulauan Seribu' => ['region' => 'DKI Jakarta', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdsnTnDOb4IaUFC-v8HkZAO8hkVxRYnniTMGqAh6Tfwg&s=10'],
            'Borobudur' => ['region' => 'Jawa Tengah', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToyHqdDGdhmiOwu2CnhN_m-f82foyIO3UAgqmgx09Xpg&s=10'],
            'Bromo-Tengger-Semeru' => ['region' => 'Jawa Timur', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBjtIAMXumfQZkP7iamn2CXoLrWGlpTmrrMEajbUqLQA&s=10'],
            'Mandalika' => ['region' => 'Nusa Tenggara Barat', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtquS1T6bEgF__TnU7X3f3uBNpPXMy3WzNnR-deCEWvQ&s=10'],
            'Labuan Bajo' => ['region' => 'Nusa Tenggara Timur', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXVBeUg421Z_gLl84uYsYG-Oo116IcaqRHB49UYwK70w&s=10'],
            'Wakatobi' => ['region' => 'Sulawesi Tenggara', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTSDzXwcoeBxGtGiWJ6BmeQZ2Qq7_inSwP0tTs9M8jRg&s=10'],
            'Morotai' => ['region' => 'Maluku', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ_9BUC0NURdCTV1EuG6TTQWtTJlwWF-VQ7fqeH0spOQ&s=10'],
        ];

        foreach ($foto_kspn as $nama_kspn => $url_foto) {
            DB::insert("INSERT INTO locations (name, region, image_url, created_at, updated_at) VALUES (?, ?, ?, ?, ?)", [
                $nama_kspn,
                $url_foto['region'],
                $url_foto['image_url'],
                now(),
                now()
            ]);
        }
    }
}