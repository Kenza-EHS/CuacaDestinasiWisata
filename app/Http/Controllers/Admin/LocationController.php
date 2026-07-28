<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\WeatherData;
use App\Models\AirQuality;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Halaman Utama Admin Panel (Daftar 10 KSPN)
    public function index()
    {
        $locations = Location::with(['latestWeather', 'latestAirQuality'])->get();
        return view('admin.locations.index', compact('locations'));
    }

    // Form Edit Destinasi & Data Cuaca
    public function edit($id)
    {
        $location = Location::with(['latestWeather', 'latestAirQuality'])->findOrFail($id);
        return view('admin.locations.edit', compact('location'));
    }

    // Proses Update Foto, Informasi, & Cuaca
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        // 0. VALIDASI DULU, sebelum menyentuh database sama sekali
        $request->validate([
            'name'        => 'required|string|max:255',
            'city'        => 'required|string|max:255',
            'province'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'temperature' => 'required|numeric|between:-40,60',
            'humidity'    => 'required|numeric|between:0,100',
            'wind_speed'  => 'required|numeric|min:0',
            'condition'   => 'required|string|max:255',
            'aqi'         => 'required|integer|min:0',
            'aqi_status'  => 'required|string|max:255',
        ]);

        // 1. Siapkan data lokasi HANYA dari field yang memang boleh diubah lewat form ini
        $dataLocation = $request->only(['name', 'city', 'province', 'description']);

        // 2. Kalau ada file gambar baru, simpan fisiknya dan masukkan path-nya ke $dataLocation
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('locations', 'public');
            $dataLocation['image'] = $imagePath;
        }

        // 3. Baru simpan ke database, sekali saja, dengan data yang sudah bersih
        $location->update($dataLocation);

        // 4. Simpan data cuaca terbaru
        WeatherData::create([
            'location_id' => $location->id,
            'temperature' => $request->temperature,
            'humidity'    => $request->humidity,
            'wind_speed'  => $request->wind_speed,
            'condition'   => $request->condition,
            'recorded_at' => now(),
        ]);

        // 5. Simpan data AQI terbaru
        AirQuality::create([
            'location_id' => $location->id,
            'aqi'         => $request->aqi,
            'pm25'        => $request->pm25 ?? rand(10, 30),
            'status'      => $request->aqi_status,
            'recorded_at' => now(),
        ]);

        // 6. Catat audit log (sekali saja)
        try {
            AuditLog::create([
                'user_id'     => auth()->id(),
                'action'      => 'UPDATE_LOCATION',
                'target'      => $location->name,
                'description' => 'Memperbarui data dan foto lokasi ' . $location->name,
            ]);
        } catch (\Exception $e) {
            \Log::error('Gagal mencatat audit log: ' . $e->getMessage());
        }

        return redirect()->route('admin.locations.index')->with('success', 'Data KSPN & Cuaca berhasil diperbarui!');
    }
}