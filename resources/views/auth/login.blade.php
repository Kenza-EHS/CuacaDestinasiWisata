@extends('layouts.app')

@section('title', 'Masuk - Cuaca KSPN')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="p-4 p-sm-5 bg-white">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex p-3 rounded-circle bg-primary bg-opacity-10 text-primary mb-2">
                            <i class="bi bi-person-circle fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-1">Selamat Datang</h3>
                        <p class="text-muted small">Masuk untuk melihat detail Kualitas Udara & Cuaca Lengkap</p>
                    </div>

                    @if($errors->has('login'))
                        <div class="alert alert-danger border-0 rounded-3 mb-3 small">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first('login') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Username atau Email</label>
                            <input type="text" name="login" class="form-control form-control-lg rounded-3 fs-6 @error('login') is-invalid @enderror" value="{{ old('login') }}" placeholder="Masukkan username atau email" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg rounded-3 fs-6" placeholder="••••••••" required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small text-secondary" for="remember">Ingat Saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-bold fs-6">Masuk Sekarang</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Akun</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection