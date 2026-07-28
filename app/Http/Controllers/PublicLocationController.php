<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class PublicLocationController extends Controller
{
    // Fungsi index untuk menampilkan semua lokasi
    public function index()
    {
        $locations = Location::all();
        return view('user.locations.index', compact('locations'));
    }

    // Hanya boleh ada SATU fungsi show() ini:
    public function show($slug)
    {
        // Mengambil data lokasi berdasarkan slug
        $location = Location::where('slug', $slug)->firstOrFail();

        // Mengirimkan variabel $location ke view
        return view('user.weather-detail', compact('location'));
    }
}