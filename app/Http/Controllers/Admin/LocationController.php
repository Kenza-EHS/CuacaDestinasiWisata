<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\WeatherData;
use App\Models\AirQuality;
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

        // Validasi Data (Termasuk Range Suhu -40 s/d 60 & Kelembaban 0-100%)
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

        // 1. Update Info Lokasi & Upload Foto Real
        $dataLocation = $request->only(['name', 'city', 'province', 'description']);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('locations', 'public');
            $dataLocation['image'] = $path;
        }
        $location->update($dataLocation);

        // 2. Update atau Buat Data Cuaca Terbaru
        // Di dalam method update():
        WeatherData::create([
            'location_id' => $location->id,
            'temperature' => $request->temperature,
            'humidity'    => $request->humidity,
            'wind_speed'  => $request->wind_speed,
            'condition'   => $request->condition,
            'recorded_at' => now(), // <-- Tambahkan ini juga
        ]);

        // 3. Update atau Buat Data AQI Terbaru
        // Di dalam method update() LocationController.php
        AirQuality::create([
            'location_id' => $location->id,
            'aqi'         => $request->aqi,
            'pm25'        => $request->pm25 ?? rand(10, 30), // <-- Tambahkan pm25
            'status'      => $request->aqi_status,
            'recorded_at' => now(),
        ]);
        

        return redirect()->route('admin.locations.index')->with('success', 'Data KSPN & Cuaca berhasil diperbarui!');
    }
}