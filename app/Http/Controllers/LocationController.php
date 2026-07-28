<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    // ================= HALAMAN USER (DATA MURNI DATABASE) =================
    public function showUserLogin()
    {
        if (session()->has('user_logged_in')) {
            return redirect('/dashboard-wisata');
        }
        return view('login-user');
    }

    public function handleUserLogin(Request $request)
    {
        if ($request->username === 'user' && $request->password === 'user123') {
            session(['user_logged_in' => true]);
            return redirect('/dashboard-wisata');
        }
        return redirect()->back()->with('error', 'Kredensial Pengguna Salah!');
    }

    public function index()
    {
        if (!session()->has('user_logged_in')) {
            return redirect('/');
        }

        // Query yang diperbaiki: Dijamin 10 KSPN keluar semua meskipun datanya kosong
        $destinations = DB::select("
            SELECT 
                l.location_id, 
                l.name, 
                l.region, 
                l.image_url, 
                w.temperature, 
                w.humidity, 
                w.condition, 
                w.created_at AS weather_updated,
                w.observation_time,
                a.ispu_value, 
                a.category AS air_category, 
                a.created_at AS air_updated
            FROM locations l
            LEFT JOIN (
                SELECT DISTINCT ON (location_id) * 
                FROM weather_data 
                ORDER BY location_id, created_at DESC
            ) w ON l.location_id = w.location_id
            LEFT JOIN (
                SELECT DISTINCT ON (location_id) * 
                FROM air_qualities 
                ORDER BY location_id, created_at DESC
            ) a ON l.location_id = a.location_id
            ORDER BY l.location_id ASC
        ");

        return view('welcome', compact('destinations'));
    }

    public function userLogout()
    {
        session()->forget('user_logged_in');
        return redirect('/');
    }

    // ================= HALAMAN ADMIN (MANAJEMEN PARAMETER) =================
    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect('/gate-secret-ekahido-2026?page=weather');
        }
        return view('admin.login');
    }

    public function handleLogin(Request $request)
    {
        if ($request->username === 'ekahido' && $request->password === 'ekahido22') {
            session(['admin_logged_in' => true]);
            return redirect('/gate-secret-ekahido-2026?page=weather');
        }
        return redirect()->back()->with('error', 'Kredensial Admin Salah!');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect('/');
    }

    public function adminPanel(Request $request)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect('/gate-secret-ekahido-2026/login');
        }

        $page = $request->query('page', 'weather'); 
        $data = [];
        
        // Mengambil kolom location_id secara eksplisit
        $data['all_locations'] = DB::select("SELECT location_id, name FROM locations ORDER BY location_id ASC");

        if ($page === 'locations') {
            $data['locations'] = DB::select("SELECT * FROM locations ORDER BY location_id ASC");
        } elseif ($page === 'weather') {
            // PERBAIKAN: Mengubah ORDER BY w.id menjadi w.created_at
            $data['weathers'] = DB::select("SELECT w.*, l.name FROM weather_data w JOIN locations l ON w.location_id = l.location_id ORDER BY w.created_at DESC");
        } elseif ($page === 'air') {
            // PERBAIKAN: Mengubah ORDER BY a.id menjadi a.created_at
            $data['airs'] = DB::select("SELECT a.*, l.name FROM air_qualities a JOIN locations l ON a.location_id = l.location_id ORDER BY a.created_at DESC");
        }

        return view('admin.dashboard', compact('page', 'data'));
    }

    // PERBAIKAN UTAMA: Menyimpan inputan parameter cuaca baru ke database pgAdmin
    public function store(Request $request)
    {
        $location_id = $request->input('location_id');
        $image_url = $request->input('image_url');
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB (2048 KB)
        ]);

        // PERBAIKAN: Hanya update foto jika kolom "image_url" diisi oleh admin
        if (!empty($image_url)) {
            \DB::update("UPDATE locations SET image_url = ?, updated_at = ? WHERE location_id = ?", [
                $image_url,
                now(),
                $location_id
            ]);
        }

        // Logika insert data cuaca bawahnya tetap biarkan seperti biasa...
        \DB::insert("INSERT INTO weather_data (location_id, temperature, humidity, condition, observation_time, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)", [
            $location_id,
            $request->input('temperature'),
            $request->input('humidity'),
            $request->input('condition'),
            now(),
            now(),
            now()
        ]);

        // Logika insert data kualitas udara bawahnya tetap biarkan seperti biasa...
        \DB::insert("INSERT INTO air_qualities (location_id, ispu_value, category, created_at, updated_at) VALUES (?, ?, ?, ?, ?)", [
            $location_id,
            $request->input('ispu_value'),
            $request->input('category'),
            now(),
            now()
        ]);

        return redirect()->back()->with('success', 'Parameter berhasil diperbarui!');
    }
}
