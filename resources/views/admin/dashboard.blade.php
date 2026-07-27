<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripWeather Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Perbaikan: min-vh diganti menjadi min-height agar sidebar memanjang ke bawah */
        .sidebar { min-height: 100vh; background-color: #1e293b; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 12px 20px; border-radius: 8px; margin-bottom: 5px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: #334155; color: #f8fafc; }
        .sidebar .nav-link.active { background-color: #0284c7; color: white; }
    </style>
</head>
<body class="bg-light">

    <div class="container-fluid">
        <!-- Tambahkan class d-flex dan min-vh-100 di bawah ini -->
        <div class="row min-vh-100">
            
            <nav class="col-md-2 sidebar p-3 text-white">
                <div class="text-center my-3">
                    <i class="bi bi-shield-lock-fill text-warning fs-1"></i>
                    <h5 class="fw-bold mt-2 text-white">Admin Panel</h5>
                    <p class="text-muted small">Ekahido Sapati 2026</p>
                </div>
                <hr class="border-secondary mb-4">
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request('page') == 'weather' || !request('page') ? 'active' : '' }}" href="/gate-secret-ekahido-2026?page=weather">
                            <i class="bi bi-cloud-sun-fill me-2"></i> Data Cuaca
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('page') == 'air' ? 'active' : '' }}" href="/gate-secret-ekahido-2026?page=air">
                            <i class="bi bi-wind me-2"></i> Kualitas Udara
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('page') == 'locations' ? 'active' : '' }}" href="/gate-secret-ekahido-2026?page=locations">
                            <i class="bi bi-geo-alt-fill me-2"></i> Daftar 10 KSPN
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <hr class="border-secondary">
                        <a class="nav-link text-danger small" href="/gate-secret-ekahido-2026/logout">
                            <i class="bi bi-box-arrow-left me-2"></i> Keluar Admin
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-10 px-md-4 py-4">
                
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">📍 {{ session('success') }}</div>
                @endif

                @if(request('page') == 'weather' || !request('page'))
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark m-0">Log Parameter Cuaca (Weather Data)</h2>
                        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#paramModal">
                            <i class="bi bi-plus-circle me-1"></i> Input Parameter Baru
                        </button>
                    </div>
                    <div class="table-responsive bg-white p-4 rounded-4 shadow-sm">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark"><tr><th>ID Log</th><th>Destinasi KSPN</th><th>Suhu</th><th>Kelembaban</th><th>Kondisi Cuaca</th><th>Waktu Observasi</th></tr></thead>
                            <tbody>
                                @foreach($data['weathers'] as $w)
                                <tr><td>{{ $w->weather_id }}</td><td class="fw-bold text-primary">{{ $w->name }}</td><td>{{ $w->temperature }}°C</td><td>{{ $w->humidity }}%</td><td>{{ $w->condition }}</td><td>{{ $w->observation_time }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @elseif(request('page') == 'air')
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark m-0">Log Kualitas Udara (Air Qualities)</h2>
                        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#paramModal">
                            <i class="bi bi-plus-circle me-1"></i> Input Parameter Baru
                        </button>
                    </div>
                    <div class="table-responsive bg-white p-4 rounded-4 shadow-sm">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark"><tr><th>ID Log</th><th>Destinasi KSPN</th><th>Nilai ISPU</th><th>Kategori Udara</th></tr></thead>
                            <tbody>
                                @foreach($data['airs'] as $a)
                                <tr><td>{{ $a->air_quality_id }}</td><td class="fw-bold text-success">{{ $a->name }}</td><td>{{ $a->ispu_value }}</td><td><span class="badge bg-success px-3 py-2">{{ $a->category }}</span></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @elseif(request('page') == 'locations')
                    <h2 class="fw-bold text-dark mb-4">Daftar Tetap 10 Wilayah KSPN</h2>
                    <div class="table-responsive bg-white p-4 rounded-4 shadow-sm">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark"><tr><th>ID Lokasi</th><th>Nama Destinasi KSPN</th><th>Wilayah / Provinsi</th></tr></thead>
                            <tbody>
                                @foreach($data['locations'] as $loc)
                                @php
                                    $showId = $loc->id_location ?? $loc->location_id ?? $loc->id ?? '-';
                                @endphp
                                <tr>
                                    <td>{{ $showId }}</td>
                                    <td class="fw-bold text-secondary">{{ $loc->name }}</td>
                                    <td>{{ $loc->region }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <div class="modal fade" id="paramModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="/gate-secret-ekahido-2026/store" method="POST" class="modal-content rounded-4">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold"><i class="bi bi-cloud-plus-fill text-primary"></i> Input Parameter Cuaca & Udara Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                    <!-- PILIH LOKASI KSPN -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Destinasi KSPN</label>
                        <select name="location_id" class="form-select" required>
                            <option value="">-- Pilih Salah Satu Lokasi --</option>
                            @foreach($data['all_locations'] as $l)
                                <option value="{{ $l->location_id }}">{{ $l->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- TAMBAHAN BARU: INPUT LINK FOTO DARI INTERNET -->
                    <div class="mb-4 p-3 bg-light rounded-3 border">
                        <label class="form-label fw-bold text-dark"><i class="bi bi-image text-danger me-1"></i> Link Foto Wisata (.jpg / .png)</label>
                        <input type="url" name="image_url" class="form-control" placeholder="Contoh: https://...">
                        <div class="form-text text-muted small">Masukkan URL gambar langsung dari internet untuk memperbarui foto cover KSPN ini.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 border-end">
                            <h6 class="fw-bold text-primary mb-3"><i class="bi bi-sun"></i> Parameter Cuaca</h6>
                            <div class="mb-3">
                                <label class="form-label">Suhu udara (°C)</label>
                                <input type="number" step="0.1" name="temperature" class="form-control" placeholder="Contoh: 27.5" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelembaban (%)</label>
                                <input type="number" name="humidity" class="form-control" placeholder="Contoh: 80" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kondisi Cuaca</label>
                                <select name="condition" class="form-select" required>
                                    <option value="Cerah">Cerah</option>
                                    <option value="Cerah Berawan">Cerah Berawan</option>
                                    <option value="Berawan">Berawan</option>
                                    <option value="Kabut">Kabut</option>
                                    <option value="Hujan Ringan">Hujan Ringan</option>
                                    <option value="Hujan Petir">Hujan Petir</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold text-success mb-3"><i class="bi bi-wind"></i> Parameter Udara</h6>
                            <div class="mb-3">
                                <label class="form-label">Nilai ISPU</label>
                                <input type="number" name="ispu_value" class="form-control" placeholder="Contoh: 35" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori Udara</label>
                                <select name="category" class="form-select" required>
                                    <option value="Baik">Baik</option>
                                    <option value="Sedang">Sedang</option>
                                    <option value="Tidak Sehat">Tidak Sehat</option>
                                    <option value="Sangat Tidak Sehat">Sangat Tidak Sehat</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Kirim ke Database</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>