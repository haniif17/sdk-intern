<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Carbon; // Wajib ada buat ngitung tanggal

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // 1. VALIDASI INPUT DASAR
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'nama_komunitas' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ruangan' => 'required',
            'waktu' => 'required',
            'no_hp' => 'required'
        ]);

        // 2. LOGIKA VALIDASI TANGGAL (H-7 GUEST, H-3 KOMUNITAS)
        $today = Carbon::today();
        $bookingDate = Carbon::parse($request->tanggal);
        $diffDays = $today->diffInDays($bookingDate, false); // false biar kalau pilih tanggal lampau hasilnya negatif

        $user = auth()->user();
        $role = $user ? $user->role : 'guest';

        if ($role === 'komunitas') {
            // Cek minimal H-3
            if ($diffDays < 3) {
                return back()->with('error', 'Gagal! Sebagai Komunitas, pemesanan minimal dilakukan H-3.');
            }
            // Overwrite nama komunitas dari database (Security)
            $namaKomunitas = $user->komunitas->nama_komunitas;
        } else {
            // Cek minimal H-7
            if ($diffDays < 7) {
                return back()->with('error', 'Gagal! Untuk tamu umum, pemesanan minimal dilakukan H-7.');
            }
            $namaKomunitas = $request->nama_komunitas;
        }

        // 3. CEK APAKAH SUDAH ADA BOOKING (YANG SUDAH APPROVED)
        $exists = Booking::where('tanggal', $request->tanggal)
            ->where('ruangan', $request->ruangan)
            ->where('waktu', $request->waktu)
            ->where('status', 'approved')
            ->exists();

        if ($exists) {
            return back()->with('error', 'Ruangan sudah dibooking di waktu tersebut!');
        }

        // 4. SIMPAN DATA
        Booking::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'nama_komunitas' => $namaKomunitas,
            'tanggal' => $request->tanggal,
            'ruangan' => $request->ruangan,
            'waktu' => $request->waktu,
            'no_hp' => $request->no_hp,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Booking berhasil! Menunggu persetujuan admin.');
    }
}