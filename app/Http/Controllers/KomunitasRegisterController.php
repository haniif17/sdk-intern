<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Komunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KomunitasRegisterController extends Controller
{
    public function create()
    {
        return view('komunitas.register');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Termasuk data baru: Nama Ketua & Jumlah Anggota)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nama_ketua' => ['required', 'string', 'max:255'],
            'jumlah_anggota' => ['required', 'integer', 'min:1'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Max 2MB
        ]);

        // 2. Simpan Akun ke tabel 'users'
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'komunitas',
        ]);

        // 3. Handle Upload Logo (Jika ada)
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $request->username . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/logos'), $filename);
            $logoPath = 'uploads/logos/' . $filename;
        }

        // 4. Simpan Profil ke tabel 'komunitas' (Status otomatis 'pending')
        Komunitas::create([
            'user_id' => $user->id,
            'nama_komunitas' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nama_ketua' => $request->nama_ketua,
            'jumlah_anggota' => $request->jumlah_anggota,
            'logo' => $logoPath,
            'status' => 'pending', 
        ]);

        // 5. Login Otomatis
        Auth::login($user);

        // 6. Redirect ke Dashboard Komunitas
        return redirect()->route('komunitas.dashboard');
    }
}