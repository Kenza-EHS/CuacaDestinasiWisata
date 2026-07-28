<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\LocationController;
use App\Models\Location;
use App\Models\AuditLog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page / Beranda (Publik)
Route::get('/', function () {
    $locations = Location::with(['latestWeather', 'latestAirQuality'])->get();
    return view('landing', compact('locations'));
})->name('home');

// 2. Auth Routes (Guest Only & Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Detail Destinasi (Hanya untuk User Terautentikasi)
Route::middleware('auth')->group(function () {
    Route::get('/destinations/{id}', function ($id) {
        $location = Location::with(['latestWeather', 'latestAirQuality'])->findOrFail($id);
        return view('destinations.show', compact('location'));
    })->name('destinations.show');
});

// 4. Admin Panel Routes (Khusus Admin) — hanya satu sumber kebenaran: Admin\LocationController
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/logs', function () {
        $auditLogs = AuditLog::with('user')->latest()->paginate(20);
        return view('admin.logs', compact('auditLogs'));
    })->name('logs');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');
});