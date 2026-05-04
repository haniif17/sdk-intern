@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Tambah Komunitas
    </h1>

    <form action="{{ url('/admin/komunitas') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nama_komunitas" class="block text-sm font-medium">Nama Komunitas</label>
            <input type="text" name="nama_komunitas" id="nama_komunitas" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium">Deskripsi Komunitas</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full px-4 py-2 border rounded-md" required></textarea>
        </div>

        <div class="mb-4">
            <label for="tanggal_gabung" class="block text-sm font-medium">Tanggal Gabung</label>
            <input type="date" name="tanggal_gabung" id="tanggal_gabung" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="jumlah_anggota" class="block text-sm font-medium">Jumlah Anggota</label>
            <input type="number" name="jumlah_anggota" id="jumlah_anggota" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium">Gambar Komunitas (Opsional)</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-md">
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg">Simpan Komunitas</button>
        </div>

    </form>

</div>

@endsection