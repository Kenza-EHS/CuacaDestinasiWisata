@extends('layouts.app')

@section('title', 'Top 10 KSPN Indonesia - Monitoring Cuaca')

@section('content')
<!-- Hero Section -->
<section class="hero-banner">
    <div class="container text-center position-relative" style="z-index: 2;">
        <span class="badge bg-info bg-opacity-20 text-info px-3 py-2 rounded-pill fw-semibold mb-3">
            <i class="bi bi-geo-alt-fill me-1"></i> Destinasi Prioritas Indonesia
        </span>
        <h1 class="display-4 fw-extrabold mb-3 text-white">Eksplorasi Cuaca 10 KSPN Unggulan</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 650px;">
            Pantau prakiraan suhu dan kondisi lingkungan secara akurat di setiap Kawasan Strategis Pariwisata Nasional.
        </p>
    </div>
</section>

<!-- Cards Grid -->
<div class="container my-5">
    <div class="row g-4">
        @foreach($locations as $loc)
            <div class="col-md-6 col-lg-4">
                <div class="card card-kspn h-100">
                    <div class="card-img-wrapper">
                        <img src="{{ $loc->image ? asset('storage/' . $loc->image) : 'https://picsum.photos/seed/' . $loc->id . '/600/400' }}" alt="{{ $loc->name }}">
                        <span class="badge-location">
                            <i class="bi bi-geo-alt text-info me-1"></i>{{ $loc->city }}
                        </span>
                    </div>

                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">{{ $loc->name }}</h4>
                            <p class="text-muted small mb-3">{{ $loc->province }}</p>

                            <!-- Minimalist Weather Pill -->
                            <div class="weather-pill d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <div class="fs-2 fw-bold text-dark lh-1">
                                        {{ $loc->latestWeather ? $loc->latestWeather->temperature . '°C' : '--' }}
                                    </div>
                                    <div class="text-secondary small mt-1 fw-medium">
                                        {{ $loc->latestWeather->condition ?? 'Data Belum Ada' }}
                                    </div>
                                </div>
                                <div class="fs-1 text-warning">
                                    <i class="bi bi-sun-fill"></i>
                                </div>
                                
                            </div>
                        </div>
                        <!-- Keterbaruan Informasi Cuaca untuk User -->
                        <div class="d-flex align-items-center small text-secondary bg-light p-3 rounded-3 border mb-4">
                            <i class="bi bi-clock-history me-2 text-primary"></i>
                            @if($loc->latestWeather)
                                <span>
                                    Data cuaca diperbarui:
                                    <strong>{{ $loc->latestWeather->recorded_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                                    <span class="text-muted">({{ $loc->latestWeather->recorded_at->diffForHumans() }})</span>
                                </span>
                            @else
                                <span>Data cuaca belum tersedia untuk lokasi ini.</span>
                            @endif
                        </div>

                        <!-- Action Button -->
                        @auth
                            <a href="{{ route('destinations.show', $loc->id) }}" class="btn btn-custom-primary w-100 d-flex align-items-center justify-content-center gap-2">
                                <span>Detail & Air Quality</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <div class="p-3 bg-light rounded-4 text-center border">
                                <p class="text-muted small mb-2 fw-medium">Buka detail AQI, Angin, & Kelembaban</p>
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-bold">
                                    <i class="bi bi-lock-fill me-1"></i> Login untuk Detail
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection