<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // VALIDASI INPUT
        $request->validate([
            'nama_kegiatan' => 'required',
            'nama_komunitas' => 'required',
            'tanggal' => 'required|date',
            'ruangan' => 'required',
            'waktu' => 'required',
            'no_hp' => 'required'
        ]);

        // CEK APAKAH SUDAH ADA BOOKING (YANG SUDAH APPROVED)
        $exists = Booking::where('tanggal', $request->tanggal)
            ->where('ruangan', $request->ruangan)
            ->where('waktu', $request->waktu)
            ->where('status', 'approved')
            ->exists();

        if ($exists) {
            return back()->with('error', 'Ruangan sudah dibooking di waktu tersebut!');
        }

        // SIMPAN DATA
        Booking::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'nama_komunitas' => $request->nama_komunitas,
            'tanggal' => $request->tanggal,
            'ruangan' => $request->ruangan,
            'waktu' => $request->waktu,
            'no_hp' => $request->no_hp,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Booking berhasil! Menunggu persetujuan admin.');
    }
}