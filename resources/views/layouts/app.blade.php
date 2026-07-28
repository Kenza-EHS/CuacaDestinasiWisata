<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cuaca KSPN Indonesia')</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            --accent-blue: #38bdf8;
            --accent-cyan: #06b6d4;
            --card-border-radius: 20px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Glassmorphism Navbar */
        .navbar-custom {
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Hero Section */
        .hero-banner {
            background: var(--primary-gradient);
            color: white;
            padding: 5rem 0 6rem;
            position: relative;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
        }

        /* Card Destinations */
        .card-kspn {
            border: none;
            border-radius: var(--card-border-radius);
            background: #ffffff;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
        }

        .card-kspn:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -10px rgba(15, 23, 42, 0.15);
        }

        .card-img-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card-kspn:hover .card-img-wrapper img {
            transform: scale(1.08);
        }

        .badge-location {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(8px);
            color: white;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .weather-pill {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 16px;
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-custom-primary:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35);
        }

        .footer-custom {
            background: #0f172a;
            color: #94a3b8;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4" href="{{ session('user_logged_in') ? url('/dashboard-wisata') : url('/') }}">
                <span class="p-2 rounded-3 bg-primary bg-opacity-20 text-info d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="bi bi-cloud-sun-fill"></i>
                </span>
                <span class="text-white">Cuaca<span class="text-info">KSPN</span></span>
            </a>

            <!-- Toggle Mobile Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Nav Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                    
                    @if(session('admin_logged_in'))
                        <!-- BERANDA ADMIN -->
                        <li class="nav-item">
                            <a class="nav-link text-white-50 px-3 active fw-medium" href="/gate-secret-ekahido-2026?page=weather">Dashboard Admin</a>
                        </li>

                        <!-- DROPDOWN PROFIL ADMIN -->
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle text-white fw-semibold d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                    A
                                </div>
                                Admin Ekahido
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2">
                                <li>
                                    <a class="dropdown-item py-2 fw-medium text-dark" href="/gate-secret-ekahido-2026?page=weather">
                                        <i class="bi bi-speedometer2 me-2 text-primary"></i>Panel Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 fw-medium text-dark" href="{{ route('admin.logs') }}">
                                        <i class="bi bi-journal-text me-2 text-info"></i>Log Aktivitas
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger py-2 fw-medium" href="/gate-secret-ekahido-2026/logout">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar Admin
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @elseif(session('user_logged_in'))
                        <!-- BERANDA USER -->
                        <li class="nav-item">
                            <a class="nav-link text-white-50 px-3 active fw-medium" href="/dashboard-wisata">Beranda Wisata</a>
                        </li>

                        <!-- DROPDOWN PROFIL USER -->
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle text-white fw-semibold d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="rounded-circle bg-info text-dark d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.85rem;">
                                    U
                                </div>
                                Pengguna
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2">
                                <li>
                                    <a class="dropdown-item py-2 fw-medium text-dark" href="/dashboard-wisata">
                                        <i class="bi bi-grid-fill me-2 text-primary"></i>Dashboard Wisata
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger py-2 fw-medium" href="/logout-user">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @else
                        <!-- TAMPILAN GUEST (BELUM LOGIN) -->
                        <li class="nav-item">
                            <a class="nav-link text-white px-3 fw-medium" href="/">Masuk User</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-info text-dark fw-bold rounded-pill px-4 ms-lg-2" href="/gate-secret-ekahido-2026/login">Masuk Admin</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!-- Global Alert -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible border-0 shadow-sm rounded-4 fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible border-0 shadow-sm rounded-4 fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom py-4 mt-5 text-center">
        <div class="container">
            <small class="fw-medium">&copy; {{ date('Y') }} Top 10 KSPN Weather Portal. Built with Laravel.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>