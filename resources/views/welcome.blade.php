<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripWeather - Info Cuaca 10 KSPN</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .bg-gradient-nav {
            background: linear-gradient(135deg, #1e3a8a 0%, #0d9488 100%);
        }
        .hero-section {
            background: linear-gradient(rgba(255, 255, 255, 0.85), rgba(248, 250, 252, 0.95)), 
                        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            padding: 100px 0 60px 0;
        }
        .card-custom {
            border: none;
            border-radius: 16px;
            background-color: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        .card-custom:hover {
            transform: translateY(-8deg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .img-destination {
            height: 200px;
            object-fit: cover;
        }
        .text-blue { color: #2563eb; }
        .text-green { color: #059669; }
        .bg-light-blue { background-color: #eff6ff; }
        .bg-light-green { background-color: #ecfdf5; }
        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

    <!-- NAVBAR UTAMA -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-nav fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <i class="bi bi-cloud-sun-fill fs-3 text-warning"></i>
                <span>TripWeather <span class="fw-light text-light-50 fs-6">berwisata</span></span>
            </a>
            
            <!-- Tambahkan Tombol Keluar untuk User Biasa ini -->
            <a href="/user-logout" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar Aplikasi
            </a>
        </div>
    </nav>

    <header class="hero-section text-center border-bottom">
        <div class="container px-4">
            <span class="badge bg-light-green text-green border border-success border-opacity-25 rounded-pill px-3 py-2 fw-bold mb-3">
                <i class="bi bi-shield-check me-1"></i> berwisata dengan nyaman - sedia aku sebelum perjalanan
            </span>
            <h1 class="display-4 fw-extrabold text-dark tracking-tight mb-3">
                Sebelum Berwisata, <span class="text-blue">Jangan Lupa Cek Cuaca!</span>
            </h1>
            <p class="lead text-muted mx-auto mb-4" style="max-width: 750px;">
                Selamat datang di platform integrasi data cuaca destinasi strategis nasional. Website ini dirancang khusus untuk memantau indikator meteorologi, kualitas udara, tingkat visibilitas, dan indeks kenyamanan termal secara berkala di <strong>10 Kawasan Strategis Pariwisata Nasional (KSPN) Indonesia</strong> demi menjamin keamanan liburan Anda.
            </p>
            <div class="d-flex justify-content-center gap-2">
                <a href="#kspn-data" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold shadow">
                    <i class="bi bi-search me-1"></i> Pantau Cuaca Hari Ini
                </a>
            </div>
        </div>
    </header>

    <section id="kspn-data" class="container py-5">
        <div class="d-flex align-items-center gap-2 mb-4">
            <div class="p-2 bg-light-blue text-blue rounded-3"><i class="bi bi-grid-3x3-gap-fill fs-4"></i></div>
            <div>
                <h3 class="fw-bold m-0 text-dark">Status Cuaca Harian & Waktu Terbaik Berkunjung</h3>
                <p class="text-muted small m-0">Menampilkan visualisasi terpadu dari database locations, weather, air quality, dan comfort level.</p>
            </div>
        </div>

        <div class="row g-4">
            @php
                $dummy_kspn = [
                    [
                        'name' => 'Danau Toba', 'region' => 'Sumatera Utara', 'condition' => 'Berawan', 'temp' => 24, 'humidity' => 82, 'ispu' => 32, 'air_cat' => 'Baik', 
                        'time' => 'Pagi Hari (07.00 - 10.00 WIB)', 'img' => 'https://images.unsplash.com/photo-1626125355203-6058e578c777?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Tanjung Kelayang', 'region' => 'Bangka Belitung', 'condition' => 'Cerah Berawan', 'temp' => 29, 'humidity' => 75, 'ispu' => 18, 'air_cat' => 'Baik', 
                        'time' => 'Sore Hari (15.30 - 18.00 WIB)', 'img' => 'https://asset.kompas.com/crops/c0Myaf3AFwCFbsEvDrT3zLOCG2M=/171x0:1000x553/750x500/data/photo/2020/02/27/5e5788fb2f500.jpg'
                    ],
                    [
                        'name' => 'Tanjung Lesung', 'region' => 'Banten', 'condition' => 'Cerah', 'temp' => 31, 'humidity' => 70, 'ispu' => 45, 'air_cat' => 'Baik', 
                        'time' => 'Pagi Hari (06.00 - 09.00 WIB)', 'img' => 'https://images.unsplash.com/photo-1505118380757-91f5f5632de0?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Kepulauan Seribu', 'region' => 'DKI Jakarta', 'condition' => 'Cerah', 'temp' => 30, 'humidity' => 72, 'ispu' => 58, 'air_cat' => 'Sedang', 
                        'time' => 'Sepanjang Hari (Gunakan Tabir Surya)', 'img' => 'https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Borobudur', 'region' => 'Jawa Tengah', 'condition' => 'Cerah Berawan', 'temp' => 27, 'humidity' => 78, 'ispu' => 42, 'air_cat' => 'Baik', 
                        'time' => 'Fajar/Sunrise (05.00 - 07.30 WIB)', 'img' => 'https://images.unsplash.com/photo-1584813530171-ec51ff560413?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Bromo-Tengger-Semeru', 'region' => 'Jawa Timur', 'condition' => 'Dingin/Cerah', 'temp' => 12, 'humidity' => 65, 'ispu' => 12, 'air_cat' => 'Baik', 
                        'time' => 'Dini Hari s/d Pagi (03.30 - 08.00 WIB)', 'img' => 'https://images.unsplash.com/photo-1602002418082-a4443e081dd1?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Mandalika', 'region' => 'Nusa Tenggara Barat', 'condition' => 'Cerah', 'temp' => 32, 'humidity' => 68, 'ispu' => 25, 'air_cat' => 'Baik', 
                        'time' => 'Sore Hari (16.00 - 18.15 WITA)', 'img' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Labuan Bajo', 'region' => 'Nusa Tenggara Timur', 'condition' => 'Cerah Berawan', 'temp' => 29, 'humidity' => 74, 'ispu' => 20, 'air_cat' => 'Baik', 
                        'time' => 'Sore Berburu Sunset (16.00 - 18.00 WITA)', 'img' => 'https://images.unsplash.com/photo-1512464090390-e414c330df3b?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Wakatobi', 'region' => 'Sulawesi Tenggara', 'condition' => 'Cerah', 'temp' => 28, 'humidity' => 77, 'ispu' => 15, 'air_cat' => 'Baik', 
                        'time' => 'Pagi Hari untuk Diving (08.00 - 11.00 WITA)', 'img' => 'https://images.unsplash.com/photo-1546026423-cc4642628d2b?auto=format&fit=crop&w=600&q=80'
                    ],
                    [
                        'name' => 'Morotai', 'region' => 'Maluku Utara', 'condition' => 'Hujan Ringan', 'temp' => 26, 'humidity' => 88, 'ispu' => 14, 'air_cat' => 'Baik', 
                        'time' => 'Siang Menjelang Sore (Aktivitas Indoor)', 'img' => 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80'
                    ]
                ];
            @endphp

            <div class="row g-4 justify-content-start">
                @foreach($destinations as $dest)
                    <div class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card w-100 border-0 shadow-sm rounded-4 overflow-hidden mb-3 d-flex flex-column justify-content-between">
                            
                            <div class="position-relative">
                                <img src="{{ $dest->image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80' }}" 
                                    class="card-img-top object-fit-cover" 
                                    alt="{{ $dest->name }}" 
                                    style="height: 200px; width: 100%;">
                                <span class="position-absolute top-0 end-0 bg-dark bg-opacity-75 text-white small px-3 py-1 m-3 rounded-pill">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $dest->region }}
                                </span>
                            </div>

                            <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                <h4 class="card-title fw-bold text-dark mb-3">{{ $dest->name }}</h4>
                                
                                <div class="row g-2 text-center mb-3">
                                    <div class="col-4">
                                        <div class="bg-light p-2 rounded-3">
                                            <span class="text-muted d-block small">Suhu</span>
                                            <strong class="text-primary">{{ $dest->temperature ?? '--' }}°C</strong>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-light p-2 rounded-3">
                                            <span class="text-muted d-block small">Lembab</span>
                                            <strong class="text-info">{{ $dest->humidity ?? '--' }}%</strong>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="bg-light p-2 rounded-3">
                                            <span class="text-muted d-block small">ISPU</span>
                                            <strong class="text-success">{{ $dest->ispu_value ?? '--' }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto d-flex justify-content-between align-items-center pt-2 border-top">
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill fw-bold">
                                        {{ $dest->condition ?? 'Belum Ada Data' }}
                                    </span>
                                    <small class="text-muted small">
                                        Obs: {{ $dest->weather_updated ? \Carbon\Carbon::parse($dest->weather_updated)->format('H:i') : '--:--' }} WIB
                                    </small>
                                </div>

                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white-50 text-center py-4 border-top border-secondary">
        <div class="container">
            <p class="m-0 small">&copy; ekahido sapati 2026 copyright all rights reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>