<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name' => 'KSPN Danau Toba',
                'slug' => 'danau-toba',
                'description' => 'Danau vulkanik terbesar di dunia sekaligus salah satu keajaiban alam paling spektakuler di Asia Tenggara. Terbentuk dari letusan gunung berapi purba puluhan ribu tahun lalu, Danau Toba menawarkan pemandangan perairan biru nan tenang yang dikelilingi perbukitan hijau Pulau Samosir di tengahnya. Menjadi pusat kebudayaan Batak yang kaya akan tradisi, musik, seni ukir, dan rumah adat Bolon, Danau Toba adalah destinasi sempurna untuk wisata alam, budaya, serta relaksasi.',
                'latitude' => 2.6083,
                'longitude' => 98.7770,
            ],
            [
                'name' => 'KSPN Candi Borobudur',
                'slug' => 'candi-borobudur',
                'description' => 'Candi Buddha terbesar di dunia yang dibangun pada abad ke-9 dan diakui sebagai Warisan Dunia UNESCO. Dikelilingi oleh Pegunungan Menoreh dan bukit-bukit asri, Mahakarya arsitektur relief batu ini menyajikan panorama matahari terbit (sunrise) yang magis dari puncaknya. Kawasan KSPN Borobudur kini terintegrasi dengan desa-desa wisata kerajinan, seni pertunjukan, dan edukasi sejarah di sekitarnya.',
                'latitude' => -7.6079,
                'longitude' => 110.2038,
            ],
            [
                'name' => 'KSPN Mandalika',
                'slug' => 'mandalika',
                'description' => 'Kawasan pariwisata pesisir pantai eksotis di Pulau Lombok yang terkenal dengan garis pantai berpasir putih menyerupai merica dan perbukitan hijau memukau. Selain menjadi rumah bagi Sirkuit Internasional Pertamina Mandalika tempat gelaran balap kelas dunia, Mandalika menawarkan keindahan Pantai Kuta Lombok, Tanjung Aan, Bukit Merese, serta kebudayaan unik suku Sasak yang menawan.',
                'latitude' => -8.8922,
                'longitude' => 116.2917,
            ],
            [
                'name' => 'KSPN Labuan Bajo',
                'slug' => 'labuan-bajo',
                'description' => 'Gerbang utama menuju Taman Nasional Komodo, habitat asli reptil purba Komodo yang dilindungi dunia. Labuan Bajo menyuguhkan pemandangan gugusan pulau-pulau eksotis seperti Pulau Padar dengan puncak ikoniknya, Pantai Pink (Pink Beach), serta titik-titik diving kelas dunia dengan keanekaragaman hayati bawah laut yang tiada duanya di Perairan Flores.',
                'latitude' => -8.4539,
                'longitude' => 119.8728,
            ],
            [
                'name' => 'KSPN Likupang',
                'slug' => 'likupang',
                'description' => 'Surga tersembunyi di bagian utara Pulau Sulawesi yang menawarkan hamparan pantai pasir putih bersih, bukit-bukit savana hijau seperti Bukit Pulisan, dan perairan jernih dengan terumbu karang yang masih sangat alami. Likupang menjadi destinasi favorit untuk ekowisata, snorkeling, dan menikmati ketenangan alam pesisir tropis.',
                'latitude' => 1.6781,
                'longitude' => 125.0564,
            ],
            [
                'name' => 'KSPN Bromo - Tengger - Semeru',
                'slug' => 'bromo-tengger-semeru',
                'description' => 'Kawasan gunung berapi aktif spektakuler yang terkenal dengan hamparan Lautan Pasir (Kaldera) seluas ribuan hektar dan fenomena sunrise emasnya di Penanjakan. Menampilkan kombinasi megah antara Gunung Bromo, Gunung Batok, dan latar belakang puncak tertinggi Pulau Jawa (Gunung Semeru), kawasan ini juga kental dengan adat tradisi dan upacara suci suku Tengger.',
                'latitude' => -7.9425,
                'longitude' => 112.9530,
            ],
            [
                'name' => 'KSPN Wakatobi',
                'slug' => 'wakatobi',
                'description' => 'Akronim dari empat pulau utamanya (Wangi-Wangi, Kaledupa, Tomia, dan Binongko), Wakatobi adalah pusat Segitiga Karang Dunia. Destinasi ini menjadi surga impian para diver global dengan ratusan spesies terumbu karang dan ribuan jenis ikan tropis, dipadukan dengan keunikan budaya masyarakat pesisir Suku Bajo.',
                'latitude' => -5.3236,
                'longitude' => 123.5962,
            ],
            [
                'name' => 'KSPN Morotai',
                'slug' => 'morotai',
                'description' => 'Pulau bersejarah di bagian terluar timur Indonesia yang pernah menjadi basis militer penting pada Perang Dunia II. Selain memancarkan pesona peninggalan artefak sejarah bawah laut dan darat, Morotai menyajikan keindahan pantai-pantai perawan seperti Pulau Dodola yang memiliki fenomena pasir timbul pembelah pulau.',
                'latitude' => 2.0520,
                'longitude' => 128.2460,
            ],
            [
                'name' => 'KSPN Raja Ampat',
                'slug' => 'raja-ampat',
                'description' => 'Labirin gugusan karang (karst) terindah di bumi yang dikelilingi perairan pirus nan jernih. Raja Ampat memegang rekor biodiversitas spesies laut tertinggi di planet ini. Pemandangan dari puncak Wayag dan Piaynemo menjadikan Raja Ampat salah satu pengalaman wisata paling eksklusif dan memukau di dunia.',
                'latitude' => -0.2342,
                'longitude' => 130.5186,
            ],
            [
                'name' => 'KSPN Kintamani - Danau Batur',
                'slug' => 'kintamani-danau-batur',
                'description' => 'Kawasan dataran tinggi Bali yang menawarkan udara sejuk dan panorama menakjubkan Gunung Batur beserta Danau Batur berbentuk bulan sabit di kalderanya. Sebagai bagian dari Batur UNESCO Global Geopark, Kintamani menjadi perpaduan sempurna antara wisata geopark, aktivitas hiking, kafe berpanorama gunung, dan budaya kuno Desa Bali Aga di Trunyan.',
                'latitude' => -8.2520,
                'longitude' => 115.3524,
            ],
        ];

        foreach ($locations as $loc) {
            Location::updateOrCreate(['slug' => $loc['slug']], $loc);
        }
    }
}
