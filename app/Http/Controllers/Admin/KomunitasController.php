<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komunitas = Komunitas::latest()->get();
        return view('admin.komunitas.index', compact('komunitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.komunitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_komunitas' => 'required',
            'deskripsi' => 'required',
            'tanggal_gabung' => 'required|date',
            'jumlah_anggota' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        $imagePath = null;

        // Upload image if available
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/komunitas'), $filename);
            $imagePath = 'images/komunitas/' . $filename;
        }

        Komunitas::create([
            'nama_komunitas' => $request->nama_komunitas,
            'deskripsi' => $request->deskripsi,
            'tanggal_gabung' => $request->tanggal_gabung,
            'jumlah_anggota' => $request->jumlah_anggota,
            'image' => $imagePath,
        ]);

        return redirect('/admin/komunitas')->with('success', 'Komunitas berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $komunitas = Komunitas::findOrFail($id);
        return view('admin.komunitas.edit', compact('komunitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $komunitas = Komunitas::findOrFail($id);

        $request->validate([
            'nama_komunitas' => 'required',
            'deskripsi' => 'required',
            'tanggal_gabung' => 'required|date',
            'jumlah_anggota' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        // Update image if available
        if ($request->hasFile('image')) {
            // Hapus gambar lama dulu sebelum upload yang baru
            if (!empty($komunitas->image) && file_exists(public_path($komunitas->image))) {
                unlink(public_path($komunitas->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/komunitas'), $filename);
            $komunitas->image = 'images/komunitas/' . $filename;
        }

        $komunitas->update([
            'nama_komunitas' => $request->nama_komunitas,
            'deskripsi' => $request->deskripsi,
            'tanggal_gabung' => $request->tanggal_gabung,
            'jumlah_anggota' => $request->jumlah_anggota,
            // Perhatikan: 'image' tidak perlu dimasukkan di sini karena sudah di-handle di atas
        ]);

        return redirect('/admin/komunitas')->with('success', 'Komunitas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $komunitas = Komunitas::findOrFail($id);

        if (!empty($komunitas->image)) {
            $path = public_path($komunitas->image);

            // Hanya hapus kalau itu file dan beneran ada
            if (file_exists($path) && is_file($path)) {
                unlink($path);
            }
        }

        $komunitas->delete();

        return redirect('/admin/komunitas')->with('success', 'Komunitas berhasil dihapus');
    }
}