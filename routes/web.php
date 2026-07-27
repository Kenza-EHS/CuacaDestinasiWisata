<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Location;

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

// 4. Admin Panel Routes (Khusus Admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Daftar & Manajemen Lokasi
    Route::get('/locations', function () {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    })->name('locations.index');

    Route::get('/locations/{id}/edit', function ($id) {
        $location = Location::findOrFail($id);
        return view('admin.locations.edit', compact('location'));
    })->name('locations.edit');

    Route::put('/locations/{id}', function (\Illuminate\Http\Request $request, $id) {
        $location = Location::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'city', 'province', 'description']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('locations', 'public');
            $data['image'] = $path;
        }

        $location->update($data);

        return redirect()->route('admin.locations.index')->with('success', 'Data destinasi berhasil diperbarui!');
    })->name('locations.update');
});
use App\Http\Controllers\Admin\LocationController;

// Admin Routes (Gunakan Controller Asli)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
    Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');
    Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');
});