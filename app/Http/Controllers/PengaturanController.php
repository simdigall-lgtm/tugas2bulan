<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PengaturanController extends Controller
{
    /**
     * File path untuk penyimpanan konfigurasi umum aplikasi.
     */
    private function getSettingsFilePath()
    {
        return storage_path('app/settings.json');
    }

    /**
     * Ambil data pengaturan umum dari settings.json dengan fallback default.
     */
    private function getSettings()
    {
        $path = $this->getSettingsFilePath();
        if (file_exists($path)) {
            $data = json_decode(@file_get_contents($path), true);
            if (is_array($data)) {
                return $data;
            }
        }

        return [
            'company_name' => 'SIPEKAN (CV Prima Grafika)',
            'company_address' => 'Jl. Percetakan Negara No. 45, Komplek Ruko Sentra Niaga Blok B2, Jakarta Pusat, DKI Jakarta 10560',
            'company_phone' => '+62 21 555 0192',
            'company_email' => 'info@sipekan.co.id',
            'company_npwp' => '01.234.567.8-012.000',
            'company_website' => 'https://sipekan.co.id',
            'currency' => 'IDR',
            'date_format' => 'DD/MM/YYYY',
            'timezone' => 'Asia/Jakarta',
        ];
    }

    /**
     * Ambil objek User yang saat ini sedang login.
     */
    private function getLoggedUser()
    {
        $sessionUser = session('user');
        $user = null;

        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
        }

        if (!$user && $sessionUser) {
            $user = User::where('name', $sessionUser)->orWhere('email', $sessionUser)->first();
        }

        if (!$user && $sessionUser) {
            $userEmail = session('user_email', 'admin@sipekan.co.id');
            $user = User::firstOrCreate(
                ['email' => $userEmail],
                ['name' => $sessionUser, 'password' => Hash::make('password')]
            );
        }

        return $user;
    }

    /**
     * Halaman Pengaturan Utama
     */
    public function index()
    {
        $currentLoggedUser = $this->getLoggedUser();
        $name = $currentLoggedUser ? $currentLoggedUser->name : session('user');
        $email = $currentLoggedUser ? $currentLoggedUser->email : '';
        $isKasir = (strtolower($name ?? '') === 'kasir' || str_contains(strtolower($email ?? ''), 'kasir'));

        if ($isKasir) {
            return redirect()->route('dashboard');
        }

        $users = User::all();
        $settings = $this->getSettings();

        return view('pengaturan', compact('users', 'settings', 'currentLoggedUser'));
    }

    /**
     * Simpan Pengaturan Umum dan Perubahan Password (AJAX / POST)
     */
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:500',
            'company_phone' => 'nullable|string|max:50',
            'company_email' => 'nullable|string|max:100',
            'company_npwp' => 'nullable|string|max:100',
            'company_website' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'date_format' => 'nullable|string|max:20',
            'timezone' => 'nullable|string|max:50',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6',
        ]);

        $settings = $this->getSettings();
        $fields = [
            'company_name',
            'company_address',
            'company_phone',
            'company_email',
            'company_npwp',
            'company_website',
            'currency',
            'date_format',
            'timezone',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $settings[$field] = trim((string)$request->input($field));
            }
        }

        // Simpan ke storage/app/settings.json
        $settingsDir = storage_path('app');
        if (!is_dir($settingsDir)) {
            @mkdir($settingsDir, 0755, true);
        }
        file_put_contents($this->getSettingsFilePath(), json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Proses perubahan kata sandi jika diisi
        $user = $this->getLoggedUser();
        if ($request->filled('new_password')) {
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Pengguna tidak ditemukan dalam sistem.'], 404);
            }

            if ($request->filled('current_password')) {
                if (!Hash::check($request->input('current_password'), $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Kata sandi saat ini yang Anda masukkan tidak cocok!'
                    ], 422);
                }
            }

            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan umum & preferensi berhasil disimpan!',
            'settings' => $settings,
        ]);
    }

    /**
     * Upload & Ganti Logo Perusahaan (AJAX / POST)
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $destDir = public_path('assets/images');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }

            $destPathPng = $destDir . DIRECTORY_SEPARATOR . 'sipekan-logo.png';
            $destPathJpg = $destDir . DIRECTORY_SEPARATOR . 'sipekan-logo.jpg';
            $destPathLogo = $destDir . DIRECTORY_SEPARATOR . 'logo.png';

            $file->move($destDir, 'sipekan-logo.png');
            @copy($destPathPng, $destPathJpg);
            @copy($destPathPng, $destPathLogo);

            $timestamp = time();
            $newUrl = asset('assets/images/sipekan-logo.png') . '?v=' . $timestamp;

            return response()->json([
                'success' => true,
                'message' => 'Logo perusahaan berhasil diperbarui ke seluruh sistem!',
                'logo_url' => $newUrl,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Berkas logo tidak valid.'], 400);
    }

    /**
     * Update Nama & Email Profil Pengguna (Modal Profil Topbar)
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = $this->getLoggedUser();
        if (!$user) {
            $user = new User();
            $user->password = Hash::make('password');
        }

        $user->name = trim($request->input('name'));
        $user->email = trim($request->input('email'));
        $user->save();

        // Update session agar navbar dan seluruh komponen langsung memuat nama & email baru
        session([
            'user' => $user->name,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil pengguna berhasil diperbarui!',
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /**
     * Upload Foto Profil Pengguna (Modal Profil Topbar)
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $destDir = public_path('assets/images');
            if (!is_dir($destDir)) {
                @mkdir($destDir, 0755, true);
            }

            $destPathPng = $destDir . DIRECTORY_SEPARATOR . 'admin-avatar.png';
            $destPathJpg = $destDir . DIRECTORY_SEPARATOR . 'admin-avatar.jpg';

            $file->move($destDir, 'admin-avatar.png');
            @copy($destPathPng, $destPathJpg);

            $timestamp = time();
            $newUrl = asset('assets/images/admin-avatar.png') . '?v=' . $timestamp;

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diperbarui!',
                'avatar_url' => $newUrl,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Berkas foto avatar tidak valid.'], 400);
    }
}
