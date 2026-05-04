@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Tambah Kegiatan
    </h1>

    {{-- Menampilkan error jika ada --}}
    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/admin/kegiatan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" id="title" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium">Deskripsi Kegiatan</label>
            <textarea name="deskripsi" id="description" class="w-full px-4 py-2 border rounded-md" required></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium">Gambar Kegiatan</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Simpan Kegiatan</button>
        </div>

    </form>

</div>

@endsection