@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Tambah Fasilitas
    </h1>

    <form action="{{ url('/admin/fasilitas') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="title"
                   class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description"
                      class="w-full border rounded-lg p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Gambar</label>
            <input type="file" name="image"
                   class="w-full border rounded-lg p-2" required>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Simpan
        </button>

    </form>

</div>

@endsection