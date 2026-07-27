<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripWeather - Masuk Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #0d9488 100%);
            min-vh: 100vh;
        }
        .login-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                
                <div class="card login-card p-4 bg-white shadow">
                    <div class="card-body">
                        
                        <div class="text-center mb-4">
                            <div class="d-inline-flex p-3 bg-light rounded-circle text-primary mb-3">
                                <i class="bi bi-cloud-sun-fill fs-2 text-primary"></i>
                            </div>
                            <h3 class="fw-bold text-dark m-0">TripWeather</h3>
                            <p class="text-muted small">Silakan login untuk memantau cuaca 10 KSPN</p>
                        </div>

                        <!-- Notifikasi Gagal -->
                        @if(session('error'))
                            <div class="alert alert-danger border-0 small rounded-3" role="alert">
                                ⚠️ {{ session('error') }}
                            </div>
                        @endif

                        <!-- Form Login User -->
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Username</label>
                                <input type="text" name="username" class="form-control bg-light" placeholder="Masukkan username user" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">Kata Sandi</label>
                                <input type="password" name="password" class="form-control bg-light" placeholder="••••••••" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold shadow">
                                Masuk Aplikasi <i class="bi bi-box-arrow-in-right ms-1"></i>
                            </button>
                        </form>

                    </div>
                </div>

                <p class="text-center text-white-50 mt-4 small">&copy; ekahido sapati 2026 copyright all rights reserved</p>

            </div>
        </div>
    </div>

</body>
</html>