@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Edit Fasilitas
    </h1>

    <form action="{{ url('/admin/fasilitas/'.$fasilitas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Judul</label>
            <input type="text" name="title"
                   value="{{ $fasilitas->title }}"
                   class="w-full border rounded-lg p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description"
                      class="w-full border rounded-lg p-2" required>{{ $fasilitas->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Gambar (opsional)</label>

            <input type="file" name="image"
                   class="w-full border rounded-lg p-2">

            <img src="{{ asset($fasilitas->image) }}"
                 class="w-24 h-24 mt-3 rounded object-cover">
        </div>

        <div class="flex space-x-4">
            <!-- Tombol Simpan -->
            <button type="submit" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-400 transition">
                Simpan
            </button>

            <!-- Tombol Batal -->
            <a href="{{ url('/admin/fasilitas') }}"
               class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection