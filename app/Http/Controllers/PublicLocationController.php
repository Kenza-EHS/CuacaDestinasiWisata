<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\View\View;

class PublicLocationController extends Controller
{
    public function index(): View
    {
        $locations = Location::with(['latestWeather', 'latestAirQuality'])->get();

        return view('landing', compact('locations'));
    }

    public function show(Location $location): View
    {
        // Load riwayat penuh untuk user terautentikasi
        $location->load(['latestWeather', 'latestAirQuality', 'weatherLogs', 'airQualityLogs']);

        return view('destinations.show', compact('location'));
    }
}