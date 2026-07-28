@extends('layouts.app')

@section('title', 'Admin Panel - Dashboard KSPN')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Admin</h2>
            <p class="text-muted mb-0">Kelola foto real KSPN & pembaruan data cuaca berkala</p>
        </div>
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
            <i class="bi bi-shield-check me-1"></i> Admin Logged In: {{ auth()->user()->name }}
        </span>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Foto Real</th>
                        <th>Nama KSPN</th>
                        <th>Lokasi</th>
                        <th>Suhu / Ket</th>
                        <th>Kelembaban</th>
                        <th>AQI</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $index => $loc)
                    <tr>
                        <td class="ps-4 fw-semibold text-secondary">{{ $index + 1 }}</td>
                        <td>
                            @if($loc->image)
                                <img src="{{ asset('storage/' . $loc->image) }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">{{ $loc->name }}</td>
                        <td class="small text-muted">{{ $loc->city }}, {{ $loc->province }}</td>
                        <td>
                            <span class="fw-bold text-dark">{{ $loc->latestWeather->temperature ?? '--' }}°C</span>
                            <div class="small text-muted">{{ $loc->latestWeather->condition ?? 'N/A' }}</div>
                        </td>
                        <td>{{ $loc->latestWeather->humidity ?? '--' }}%</td>
                        <td>
                            <span class="badge bg-success bg-opacity-10 text-success fw-bold">
                                {{ $loc->latestAirQuality->aqi ?? '--' }} ({{ $loc->latestAirQuality->status ?? '-' }})
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.locations.edit', $loc->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-semibold">
                                <i class="bi bi-pencil-square me-1"></i> Edit Data
                            </a>
                            <form action="{{ route('admin.locations.destroy', $loc->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin hapus {{ $loc->name }}? Seluruh histori cuaca & AQI-nya akan ikut terhapus dan tidak bisa dikembalikan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold ms-2">
                                    <i class="bi bi-trash3 me-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection