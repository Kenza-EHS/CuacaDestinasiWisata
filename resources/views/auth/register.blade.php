@extends('layouts.app')

@section('title', 'Daftar - Cuaca KSPN')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="p-4 p-sm-5 bg-white">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">Buat Akun Baru</h3>
                        <p class="text-muted small">Daftar gratis untuk akses fitur pemantauan cuaca KSPN</p>
                    </div>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Username</label>
                                <input type="text" name="username" class="form-control rounded-3 @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="contoh: johndoe" required>
                                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Email</label>
                                <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="nama@email.com" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Password</label>
                                <input type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small text-secondary">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control rounded-3" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-bold fs-6">Daftar Akun</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection