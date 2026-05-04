@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Edit Kegiatan
    </h1>

    <form action="{{ url('/admin/kegiatan/'.$kegiatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tanggal --}}
        <div class="mb-4">
            <label class="block">Tanggal</label>
            <input type="date" name="tanggal"
                   value="{{ $kegiatan->tanggal }}"
                   class="w-full border rounded-lg p-2" required>
        </div>

        {{-- Nama --}}
        <div class="mb-4">
            <label class="block">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan"
                   value="{{ $kegiatan->nama_kegiatan }}"
                   class="w-full border rounded-lg p-2" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block">Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full border rounded-lg p-2" required>{{ $kegiatan->deskripsi }}</textarea>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="block">Gambar (opsional)</label>
            <input type="file" name="image"
                   class="w-full border rounded-lg p-2">

            <img src="{{ asset($kegiatan->image) }}"
                 class="w-24 mt-3 rounded">
        </div>

        <div class="flex space-x-4">
            <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
                Update
            </button>

            <a href="/admin/kegiatan"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection