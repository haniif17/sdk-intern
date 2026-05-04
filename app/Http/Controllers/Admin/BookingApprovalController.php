<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingApprovalController extends Controller
{
    // Menampilkan daftar booking yang pending dan log
    public function index()
    {
        // 1. Data untuk tabel atas (Semua Log)
        $bookings = Booking::latest()->get();
        
        // 2. Data untuk tabel bawah (Khusus yang Approved / Booked saja)
        $bookedList = Booking::where('status', 'approved')->latest()->get();

        return view('admin.booking.index', compact('bookings', 'bookedList'));
    }

    // Approve booking
    public function approve($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'approved';
        $booking->log = 'Booking approved by admin on ' . now()->toDateTimeString();  // Menambahkan log
        $booking->save();

        // Kirim WA link otomatis
        $this->sendWhatsAppMessage($booking->no_hp, $booking->nama_kegiatan, $booking->tanggal);

        return redirect()->route('admin.booking.index')->with('success', 'Booking approved');
    }

    public function reject($id)
    {
        $booking = Booking::find($id);
        $booking->status = 'rejected';
        $booking->log = 'Booking rejected by admin on ' . now()->toDateTimeString();  // Menambahkan log
        $booking->save();

        return redirect()->route('admin.booking.index')->with('error', 'Booking rejected');
    }

    // Fungsi untuk mengirim pesan WA (Link)
    private function sendWhatsAppMessage($phoneNumber, $kegiatan, $tanggal)
    {
        $message = urlencode("Booking Anda untuk kegiatan '$kegiatan' pada tanggal $tanggal telah ditolak. Silakan menghubungi kami.");
        $url = "https://wa.me/{$phoneNumber}?text={$message}";

        // Buka link WhatsApp
        return redirect($url);
    }

    // =========================================================================
    // TAMBAHAN BARU: FUNGSI UNTUK TABEL BOOKED (EDIT & HAPUS)
    // =========================================================================

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'nama_komunitas' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'ruangan' => 'required',
            'no_hp' => 'required'
        ]);

        // CEK APAKAH SUDAH ADA BOOKING APPROVED DI JADWAL TERSEBUT
        // (Tapi abaikan ID booking yang sedang diedit ini biar gak bentrok sama dirinya sendiri)
        $exists = Booking::where('tanggal', $request->tanggal)
            ->where('ruangan', $request->ruangan)
            ->where('waktu', $request->waktu)
            ->where('status', 'approved')
            ->where('id', '!=', $id) 
            ->exists();

        if ($exists) {
            return back()->with('error', 'Gagal update! Ruangan sudah dibooking di tanggal dan waktu tersebut.')->withInput();
        }

        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'nama_komunitas' => $request->nama_komunitas,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'ruangan' => $request->ruangan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.booking.index')->with('success', 'Data Booked berhasil diupdate');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.booking.index')->with('success', 'Data Booked berhasil dihapus');
    }
}