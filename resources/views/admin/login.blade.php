<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripWeather - Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #eff6ff 100%);
            min-vh: 100vh;
        }
        .login-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #059669 100%);
            border: none;
            color: white;
        }
        .btn-gradient:hover {
            opacity: 0.9;
            color: white;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <!-- Tombol Kembali ke Utama -->
                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none text-muted smallfw-semibold">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda Utama
                    </a>
                </div>

                <div class="card login-card p-4 bg-white">
                    <div class="card-body">
                        
                        <!-- Logo & Judul -->
                        <div class="text-center mb-4">
                            <div class="d-inline-flex p-3 bg-light rounded-circle text-primary mb-3">
                                <i class="bi bi-shield-lock-fill fs-2 text-primary"></i>
                            </div>
                            <h4 class="fw-bold text-dark m-0">TripWeather Admin</h4>
                            <p class="text-muted small">Silakan masuk untuk mengelola data KSPN</p>
                        </div>

                        <!-- Notifikasi Error Login -->
                        @if(session('error'))
                            <div class="alert alert-danger border-0 small rounded-3" role="alert">
                                ⚠️ {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form Login (Mengarah ke URL Rahasia POST) -->
                        <form action="/gate-secret-ekahido-2026/login" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Username / Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                    <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Masukkan username" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient w-100 py-2.5 rounded-3 fw-bold shadow-sm">
                                Masuk ke Dashboard <i class="bi bi-box-arrow-in-right ms-1"></i>
                            </button>
                        </form>

                    </div>
                </div>

                <!-- Footer Custom sesuai Request -->
                <p class="text-center text-muted mt-4 small">&copy; ekahido sapati 2026 copyright all rights reserved</p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>