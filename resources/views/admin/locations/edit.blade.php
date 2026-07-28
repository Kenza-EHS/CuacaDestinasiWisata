@extends('layouts.app')

@section('title', 'Edit - ' . $location->name)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="fw-bold text-dark mb-0">Update Data KSPN</h3>
                        <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <ul class="mb-0 small ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Alert Notifikasi --}}
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- PASTIKAN ENCTYPE TERPASANG DENGAN BENAR --}}
                    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="border-b pb-4">
                            <h2 class="text-lg font-semibold text-blue-600 mb-4 flex items-center gap-2">
                                📍 Informasi Destinasi
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Destinasi KSPN</label>
                                    <input type="text" name="name" value="{{ old('name', $location->name) }}" class="w-full border-gray-300 rounded-lg p-2.5 border" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten</label>
                                    <input type="text" name="city" value="{{ old('city', $location->city) }}" class="w-full border-gray-300 rounded-lg p-2.5 border">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                    <input type="text" name="province" value="{{ old('province', $location->province) }}" class="w-full border-gray-300 rounded-lg p-2.5 border">
                                </div>
                            </div>

                            {{-- BAGIAN FOTO --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Real Destinasi</label>
                                
                                {{-- Tampilkan Pratinjau Foto jika Ada --}}
                                @if($location->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="w-48 h-32 object-cover rounded-lg border">
                                    </div>
                                @endif

                                <input type="file" name="image" class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                                <p class="text-xs text-gray-500 mt-1">Upload gambar real destinasi (JPG, PNG, WEBP max 2MB)</p>
                            </div>
                        </div>

                        {{-- TOMBOL SIMPAN DI BAAGIAN BIKIN BAWAH --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>

                        <hr class="my-4">

                        <!-- Section 2: Input Cuaca Terkini -->
                        <h5 class="fw-bold text-primary mb-3"><i class="bi bi-cloud-sun me-2"></i>Pembaruan Data Cuaca & AQI</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-secondary">Suhu (°C)</label>
                                <input type="number" step="0.1" name="temperature" class="form-control rounded-3" value="{{ old('temperature', $location->latestWeather->temperature ?? 25) }}" required>
                                <small class="text-muted">Min: -40°C, Max: 60°C</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-secondary">Kelembaban (%)</label>
                                <input type="number" name="humidity" class="form-control rounded-3" value="{{ old('humidity', $location->latestWeather->humidity ?? 70) }}" required>
                                <small class="text-muted">Range: 0% - 100%</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-secondary">Kecepatan Angin (km/h)</label>
                                <input type="number" name="wind_speed" class="form-control rounded-3" value="{{ old('wind_speed', $location->latestWeather->wind_speed ?? 10) }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-secondary">Kondisi Cuaca</label>
                                <select name="condition" class="form-select rounded-3">
                                    <option value="Cerah" {{ ($location->latestWeather->condition ?? '') == 'Cerah' ? 'selected' : '' }}>Cerah</option>
                                    <option value="Berawan" {{ ($location->latestWeather->condition ?? '') == 'Berawan' ? 'selected' : '' }}>Berawan</option>
                                    <option value="Berawan Tebal" {{ ($location->latestWeather->condition ?? '') == 'Berawan Tebal' ? 'selected' : '' }}>Berawan Tebal</option>
                                    <option value="Hujan Ringan" {{ ($location->latestWeather->condition ?? '') == 'Hujan Ringan' ? 'selected' : '' }}>Hujan Ringan</option>
                                    <option value="Hujan Lebat" {{ ($location->latestWeather->condition ?? '') == 'Hujan Lebat' ? 'selected' : '' }}>Hujan Lebat</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-secondary">AQI Value</label>
                                <input type="number" name="aqi" class="form-control rounded-3" value="{{ old('aqi', $location->latestAirQuality->aqi ?? 30) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small text-secondary">Status AQI</label>
                                <input type="text" name="aqi_status" class="form-control rounded-3" value="{{ old('aqi_status', $location->latestAirQuality->status ?? 'Baik') }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-bold">Simpan Pembaruan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection