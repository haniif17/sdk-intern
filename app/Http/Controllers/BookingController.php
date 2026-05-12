<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Holiday; // Memastikan model Holiday terpakai
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    // --- FUNGSI UNTUK MENAMPILKAN HALAMAN PESAN RUANGAN ---
    public function index()
    {
        // 1. Ambil data booking yang sudah approved untuk tampil di kalender
        $bookings = Booking::where('status', 'approved')->get();

        // 2. Ambil data hari libur yang sudah lu input di Admin Panel
        $holidays = Holiday::all();

        // 3. Kirim kedua data tersebut ke view
        return view('pages.pesan-ruangan', compact('bookings', 'holidays'));
    }

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
        $diffDays = $today->diffInDays($bookingDate, false);

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

        // --- TAMBAHAN: LOGIKA PENGECEKAN HARI LIBUR UNTUK LOG DATABASE ---
        $hariLibur = Holiday::where('tanggal', $request->tanggal)->first();
        $catatanLog = "Pemesanan baru."; // Pesan default

        if ($hariLibur) {
            // Jika tanggal booking pas dengan hari libur, buat catatan khusus
            $catatanLog = "Peringatan: Booking pada hari libur (" . $hariLibur->keterangan . ")";
        }

        // 4. SIMPAN DATA
        Booking::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'nama_komunitas' => $namaKomunitas,
            'tanggal' => $request->tanggal,
            'ruangan' => $request->ruangan,
            'waktu' => $request->waktu,
            'no_hp' => $request->no_hp,
            'status' => 'pending',
            'log' => $catatanLog // Kolom log otomatis terisi info libur
        ]);

        return back()->with('success', 'Booking berhasil! Menunggu persetujuan admin.');
    }
}