<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = \App\Models\Fasilitas::latest()->get();

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        // upload gambar
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/fasilitas'), $filename);

        // simpan ke database
        \App\Models\Fasilitas::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'images/fasilitas/' . $filename,
        ]);

        return redirect('/admin/fasilitas')->with('success', 'Fasilitas berhasil ditambahkan');
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
        $fasilitas = \App\Models\Fasilitas::findOrFail($id);

        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $fasilitas = \App\Models\Fasilitas::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        // kalau upload gambar baru
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/fasilitas'), $filename);

            $fasilitas->image = 'images/fasilitas/' . $filename;
        }

        $fasilitas->title = $request->title;
        $fasilitas->description = $request->description;
        $fasilitas->save();

        return redirect('/admin/fasilitas')->with('success', 'Fasilitas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fasilitas = \App\Models\Fasilitas::findOrFail($id);

        // hapus file gambar
        if (file_exists(public_path($fasilitas->image))) {
            unlink(public_path($fasilitas->image));
        }

        // hapus data
        $fasilitas->delete();

        return redirect('/admin/fasilitas')->with('success', 'Fasilitas berhasil dihapus');
    }
}
