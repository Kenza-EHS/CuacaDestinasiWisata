<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWeatherDataRequest;
use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WeatherController extends Controller
{
    public function index(): View
    {
        $weatherLogs = WeatherData::with('location')
            ->latest('recorded_at')
            ->paginate(15);

        return view('admin.weather.index', compact('weatherLogs'));
    }

    public function create(): View
    {
        $locations = Location::select('id', 'name')->get();
        return view('admin.weather.create', compact('locations'));
    }

    public function store(StoreWeatherDataRequest $request): RedirectResponse
    {
        WeatherData::create($request->validated());

        return redirect()->route('admin.weather.index')
            ->with('success', 'Catatan cuaca baru berhasil ditambahkan.');
    }

    public function destroy(WeatherData $weather): RedirectResponse
    {
        $weather->delete();

        return redirect()->route('admin.weather.index')
            ->with('success', 'Catatan cuaca berhasil dihapus.');
    }
}