<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Lokasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar min-vh-100 p-3 text-white">
                <h5 class="text-center fw-bold mb-4 text-warning">Admin Panel</h5>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item"><a class="nav-link text-white bg-primary rounded p-2" href="/admin/locations">📍 Kelola Lokasi</a></li>
                    <li class="nav-item"><a class="nav-link text-light p-2" href="#">🌤️ Data Cuaca</a></li>
                    <li class="nav-item"><a class="nav-link text-light p-2" href="#">🍃 Kualitas Udara</a></li>
                    <li class="nav-item"><hr class="bg-secondary"></li>
                    <li class="nav-item"><a class="nav-link text-danger p-2 small" href="/">⬅️ Kembali ke Menu Utama</a></li>
                </ul>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 fw-bold text-dark">Manajemen Tabel Lokasi (Location)</h1>
                    <button class="btn btn-primary btn-sm px-3 shadow" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah KSPN</button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✨ {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="table-responsive bg-white p-4 rounded shadow-sm">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Lokasi</th>
                                <th>Nama Destinasi (KSPN)</th>
                                <th>Wilayah / Region</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($locations as $loc)
                                <tr>
                                    <td><span class="badge bg-secondary">{{ $loc->location_id }}</span></td>
                                    <td class="fw-bold text-primary">{{ $loc->name }}</td>
                                    <td>{{ $loc->region }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Tabel lokasi kosong. Silakan tambah data baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Sebelum: <form action="/admin/locations" method="POST" class="modal-content"> -->
<!-- Ubah Menjadi: -->
            <form action="/gate-secret-ekahido-2026" method="POST" class="modal-content">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">Tambah Lokasi KSPN Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Destinasi Wisata (Whitelist)</label>
                        <select name="name" class="form-select" required>
                            <option value="">-- Pilih 10 Destinasi KSPN --</option>
                            <option value="Danau Toba">Danau Toba</option>
                            <option value="Tanjung Kelayang">Tanjung Kelayang</option>
                            <option value="Tanjung Lesung">Tanjung Lesung</option>
                            <option value="Kepulauan Seribu">Kepulauan Seribu</option>
                            <option value="Borobudur">Borobudur</option>
                            <option value="Bromo-Tengger-Semeru">Bromo-Tengger-Semeru</option>
                            <option value="Mandalika">Mandalika</option>
                            <option value="Labuan Bajo">Labuan Bajo</option>
                            <option value="Wakatobi">Wakatobi</option>
                            <option value="Morotai">Morotai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Wilayah (Region)</label>
                        <input type="text" name="region" class="form-control" placeholder="Contoh: Sumatera Utara" required maxlength="100">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan (Binding SQL)</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>