@extends('layouts.app')

@section('title', 'Detail - ' . $location->name)

@section('content')
<div class="container py-5">
    <!-- Back Button -->
    <a href="{{ route('home') }}" class="btn btn-white shadow-sm rounded-pill px-4 py-2 mb-4 fw-semibold text-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>

    <div class="row g-4">
        <!-- Main Image Card -->
        <div class="col-lg-5">
            <div class="card card-kspn overflow-hidden border-0 shadow-sm">
                <img src="{{ $location->image ? asset('storage/' . $location->image) : 'https://picsum.photos/seed/' . $location->id . '/600/400' }}" class="img-fluid" style="height: 300px; object-fit: cover;" alt="{{ $location->name }}">
                <div class="card-body p-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-2 rounded-pill mb-2">Destinasi KSPN</span>
                    <h2 class="fw-bold text-dark">{{ $location->name }}</h2>
                    <p class="text-muted"><i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $location->city }}, {{ $location->province }}</p>
                    <p class="text-secondary leading-relaxed mb-0">{{ $location->description ?? 'Deskripsi kawasan belum ditambahkan.' }}</p>
                </div>
            </div>
        </div>

        <!-- Environmental Metrics Grid -->
        <div class="col-lg-7">
            <h4 class="fw-bold mb-3 text-dark">Kondisi Lingkungan Terkini</h4>
            
            <div class="row g-3">
                <!-- Temperature -->
                <div class="col-sm-6">
                    <div class="p-4 bg-white rounded-4 shadow-sm border border-light-subtle h-100">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted fw-semibold small">Suhu Udara</span>
                            <i class="bi bi-thermometer-half text-danger fs-4"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $location->latestWeather->temperature ?? '--' }}°C</h2>
                        <small class="text-secondary fw-medium">{{ $location->latestWeather->condition ?? 'N/A' }}</small>
                    </div>
                </div>

                <!-- Humidity -->
                <div class="col-sm-6">
                    <div class="p-4 bg-white rounded-4 shadow-sm border border-light-subtle h-100">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted fw-semibold small">Kelembaban</span>
                            <i class="bi bi-droplet-fill text-info fs-4"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $location->latestWeather->humidity ?? '--' }}%</h2>
                        <small class="text-secondary fw-medium">Kadar air dalam udara</small>
                    </div>
                </div>

                <!-- Wind Speed -->
                <div class="col-sm-6">
                    <div class="p-4 bg-white rounded-4 shadow-sm border border-light-subtle h-100">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted fw-semibold small">Kecepatan Angin</span>
                            <i class="bi bi-wind text-primary fs-4"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $location->latestWeather->wind_speed ?? '--' }} <span class="fs-6 text-muted fw-normal">km/h</span></h2>
                        <small class="text-secondary fw-medium">Kecepatan hembusan</small>
                    </div>
                </div>

                <!-- AQI / Air Quality -->
                <div class="col-sm-6">
                    <div class="p-4 bg-white rounded-4 shadow-sm border border-light-subtle h-100">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted fw-semibold small">Air Quality Index (AQI)</span>
                            <i class="bi bi-shield-check text-success fs-4"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $location->latestAirQuality->aqi ?? '--' }}</h2>
                        <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1 rounded mt-1">
                            Status: {{ $location->latestAirQuality->status ?? 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection