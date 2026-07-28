<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location; // Ditambahkan agar tidak error Class Not Found

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
            $data['weathers'] = DB::select("SELECT w.*, l.name FROM weather_data w JOIN locations l ON w.location_id = l.location_id ORDER BY w.created_at DESC");
        } elseif ($page === 'air') {
            $data['airs'] = DB::select("SELECT a.*, l.name FROM air_qualities a JOIN locations l ON a.location_id = l.location_id ORDER BY a.created_at DESC");
        }

        return view('admin.dashboard', compact('page', 'data'));
    }

    // SIMPAN PARAMETER BARU (Form Tambah Data Admin)
    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url'   => 'nullable|string',
        ]);

        $location_id = $request->input('location_id');
        $image_url   = $request->input('image_url');

        // Handling upload file foto via Input File HTML
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('locations', 'public');
            $image_url = $path;
        }

        // Update foto di tabel locations jika ada input foto/link
        if (!empty($image_url)) {
            DB::update("UPDATE locations SET image_url = ?, updated_at = ? WHERE location_id = ?", [
                $image_url,
                now(),
                $location_id
            ]);
        }

        // Insert data cuaca
        if ($request->filled('temperature')) {
            DB::insert("INSERT INTO weather_data (location_id, temperature, humidity, condition, observation_time, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)", [
                $location_id,
                $request->input('temperature'),
                $request->input('humidity'),
                $request->input('condition'),
                now(),
                now(),
                now()
            ]);
        }

        // Insert data kualitas udara
        if ($request->filled('ispu_value')) {
            DB::insert("INSERT INTO air_qualities (location_id, ispu_value, category, created_at, updated_at) VALUES (?, ?, ?, ?, ?)", [
                $location_id,
                $request->input('ispu_value'),
                $request->input('category'),
                now(),
                now()
            ]);
        }

        // Catat Log Aktivitas
        $this->recordLog('TAMBAH_DATA', 'Lokasi ID: ' . $location_id, 'Menambahkan parameter cuaca/udara/foto baru');

        return redirect()->back()->with('success', 'Data parameter berhasil disimpan!');
    }

    // UPDATE DATA LOKASI DAN FOTO (Form Edit)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $locationName = $request->input('name');
        $imagePath = null;

        // Proses unggah file foto
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('locations', 'public');
        }

        // Query update yang mendukung struktur pgAdmin (kolom location_id & image_url)
        if ($imagePath && $locationName) {
            DB::update("UPDATE locations SET name = ?, image_url = ?, updated_at = ? WHERE location_id = ?", [
                $locationName, $imagePath, now(), $id
            ]);
        } elseif ($imagePath) {
            DB::update("UPDATE locations SET image_url = ?, updated_at = ? WHERE location_id = ?", [
                $imagePath, now(), $id
            ]);
        } elseif ($locationName) {
            DB::update("UPDATE locations SET name = ?, updated_at = ? WHERE location_id = ?", [
                $locationName, now(), $id
            ]);
        }

        // Catat Audit Log
        $targetName = $locationName ?? 'ID ' . $id;
        $this->recordLog('UPDATE_LOCATION', $targetName, 'Memperbarui data & foto lokasi ' . $targetName);

        return redirect()->back()->with('success', 'Data lokasi dan foto berhasil diperbarui!');
    }

    // Helper Fungsi untuk Mencatat Audit Log secara Aman
    private function recordLog($action, $target, $description)
    {
        try {
            if (class_exists('App\Models\AuditLog')) {
                \App\Models\AuditLog::create([
                    'user_id'     => auth()->id() ?? 1, // Fallback ke Admin ID 1
                    'action'      => $action,
                    'target'      => $target,
                    'description' => $description,
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Gagal mencatat Audit Log: ' . $e->getMessage());
        }
    }
}