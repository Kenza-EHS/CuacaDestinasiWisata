<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    // ================= HALAMAN USER =================
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

    // ================= HALAMAN ADMIN =================
    public function showLogin()
    {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function handleLogin(Request $request)
    {
        if ($request->username === 'ekahido' && $request->password === 'ekahido22') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
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
            return redirect()->route('admin.login');
        }

        $page = $request->query('page', 'weather'); 
        $data = [];
        
        $data['all_locations'] = DB::select("SELECT location_id, name FROM locations ORDER BY location_id ASC");

        if ($page === 'locations') {
            $data['locations'] = DB::select("SELECT * FROM locations ORDER BY location_id ASC");
        } elseif ($page === 'weather') {
            $data['weathers'] = DB::select("SELECT w.*, l.name FROM weather_data w JOIN locations l ON w.location_id = l.location_id ORDER BY w.created_at DESC");
        } elseif ($page === 'air') {
            $data['airs'] = DB::select("SELECT a.*, l.name FROM air_qualities a JOIN locations l ON a.location_id = l.location_id ORDER BY a.created_at DESC");
        }

        return view('admin.dashboard', compact('page', 'data'));
    }

    // ================= SIMPAN & UPDATE DATA (AMAN DARI ERROR 500) =================
    public function store(Request $request)
    {
        $location_id = $request->input('location_id');
        $image_url = $request->input('image_url');

        // Handling Upload Foto File
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image_url = $request->file('image')->store('locations', 'public');
        }

        if (!empty($image_url)) {
            DB::update("UPDATE locations SET image_url = ?, updated_at = ? WHERE location_id = ?", [
                $image_url, now(), $location_id
            ]);
        }

        if ($request->filled('temperature')) {
            DB::insert("INSERT INTO weather_data (location_id, temperature, humidity, condition, observation_time, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)", [
                $location_id, $request->input('temperature'), $request->input('humidity'), $request->input('condition'), now(), now(), now()
            ]);
        }

        if ($request->filled('ispu_value')) {
            DB::insert("INSERT INTO air_qualities (location_id, ispu_value, category, created_at, updated_at) VALUES (?, ?, ?, ?, ?)", [
                $location_id, $request->input('ispu_value'), $request->input('category'), now(), now()
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('locations', 'public');
            DB::update("UPDATE locations SET image_url = ?, updated_at = ? WHERE location_id = ?", [
                $path, now(), $id
            ]);
        }

        if ($request->filled('name')) {
            DB::update("UPDATE locations SET name = ?, updated_at = ? WHERE location_id = ?", [
                $request->input('name'), now(), $id
            ]);
        }

        return redirect()->back()->with('success', 'Lokasi & Foto berhasil diperbarui!');
    }
}