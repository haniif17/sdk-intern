<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatans = \App\Models\Kegiatan::latest()->get();

        return view('admin.kegiatan.index', compact('kegiatans'));
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image',
        ]);

        // Upload gambar
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        
        // Pindahkan file ke folder yang benar
        $image->move(public_path('images/kegiatan'), $filename);

        // Simpan ke database
        \App\Models\Kegiatan::create([
            'tanggal' => $request->tanggal,
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi' => $request->deskripsi,
            'image' => 'images/kegiatan/' . $filename,
        ]);

        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatan = \App\Models\Kegiatan::findOrFail($id);

        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kegiatan = \App\Models\Kegiatan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image',
        ]);

        // kalau upload gambar baru
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/kegiatan'), $filename);

            $kegiatan->image = 'images/kegiatan/' . $filename;
        }

        $kegiatan->tanggal = $request->tanggal;
        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->deskripsi = $request->deskripsi;
        $kegiatan->save();

        return redirect('/admin/kegiatan')->with('success', 'Kegiatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komunitas $komunitas)
    {
        // hapus gambar
        if ($komunitas->image && file_exists(public_path($komunitas->image))) {
            unlink(public_path($komunitas->image));
        }

        // hapus data komunitas
        $komunitas->delete();

        // redirect balik ke halaman index
        return redirect('/admin/komunitas')->with('success', 'Komunitas berhasil dihapus');
    }
}
