<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAirQualityRequest;
use App\Models\AirQuality;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AirQualityController extends Controller
{
    public function index(): View
    {
        $airQualityLogs = AirQuality::with('location')
            ->latest('recorded_at')
            ->paginate(15);

        return view('admin.air-quality.index', compact('airQualityLogs'));
    }

    public function create(): View
    {
        $locations = Location::select('id', 'name')->get();
        return view('admin.air-quality.create', compact('locations'));
    }

    public function store(StoreAirQualityRequest $request): RedirectResponse
    {
        AirQuality::create($request->validated());

        return redirect()->route('admin.air-quality.index')
            ->with('success', 'Catatan kualitas udara berhasil ditambahkan.');
    }

    public function destroy(AirQuality $airQuality): RedirectResponse
    {
        $airQuality->delete();

        return redirect()->route('admin.air-quality.index')
            ->with('success', 'Catatan kualitas udara berhasil dihapus.');
    }
}