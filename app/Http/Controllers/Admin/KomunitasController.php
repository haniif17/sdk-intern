<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use App\Models\User;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    public function index()
    {
        $komunitas = Komunitas::latest()->get();
        return view('admin.komunitas.index', compact('komunitas'));
    }

    public function create()
    {
        return view('admin.komunitas.create');
    }

    public function store(Request $request)
    {
        // Karena pendaftaran sekarang via form luar, kita arahkan admin ke sana
        return redirect()->route('komunitas.register')->with('info', 'Silakan gunakan form registrasi utama untuk mendaftarkan komunitas baru.');
    }

    public function edit($id)
    {
        $komunitas = Komunitas::findOrFail($id);
        return view('admin.komunitas.edit', compact('komunitas'));
    }

    public function update(Request $request, $id)
    {
        $komunitas = Komunitas::findOrFail($id);

        $request->validate([
            'nama_komunitas' => 'required',
            'deskripsi' => 'nullable|string', // Nullable karena awal daftar belum ada deskripsi
            'jumlah_anggota' => 'required|integer',
            'logo' => 'nullable|image|max:2048', // Kolomnya logo, bukan image lagi
        ]);

        // Update logo if available
        if ($request->hasFile('logo')) {
            // Hapus logo lama dulu
            if (!empty($komunitas->logo) && file_exists(public_path($komunitas->logo))) {
                unlink(public_path($komunitas->logo));
            }

            $logo = $request->file('logo');
            $filename = time() . '_' . $komunitas->username . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/logos'), $filename);
            $komunitas->logo = 'uploads/logos/' . $filename; // Simpan path baru
        }

        $komunitas->update([
            'nama_komunitas' => $request->nama_komunitas,
            'deskripsi' => $request->deskripsi,
            'jumlah_anggota' => $request->jumlah_anggota,
            // tanggal_gabung dihapus, kita pakai created_at bawaan Laravel
        ]);

        return redirect('/admin/komunitas')->with('success', 'Data Komunitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $komunitas = Komunitas::findOrFail($id);

        // Hapus Logo fisik jika ada
        if (!empty($komunitas->logo) && file_exists(public_path($komunitas->logo))) {
            unlink(public_path($komunitas->logo));
        }

        // Ambil ID User terkait untuk dihapus juga akun loginnya
        $userId = $komunitas->user_id;
        
        $komunitas->delete();
        
        // Bersihkan tabel users
        if ($userId) {
            User::where('id', $userId)->delete();
        }

        return redirect('/admin/komunitas')->with('success', 'Data komunitas dan akun akses berhasil dihapus.');
    }

    // =======================================
    // FUNGSI APPROVAL
    // =======================================
    public function approve($id)
    {
        $komunitas = Komunitas::findOrFail($id);
        $komunitas->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Komunitas ' . $komunitas->nama_komunitas . ' berhasil di-approve!');
    }

    public function reject($id)
    {
        $komunitas = Komunitas::findOrFail($id);
        $komunitas->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Komunitas ' . $komunitas->nama_komunitas . ' telah ditolak.');
    }
}