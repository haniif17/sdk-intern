@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Edit Komunitas
    </h1>

    <form action="{{ url('/admin/komunitas/'.$komunitas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Komunitas --}}
        <div class="mb-4">
            <label>Nama Komunitas</label>
            <input type="text" name="nama_komunitas"
                   value="{{ $komunitas->nama_komunitas }}"
                   class="w-full border rounded p-2" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label>Deskripsi</label>
            <textarea name="deskripsi"
                      class="w-full border rounded p-2" required>{{ $komunitas->deskripsi }}</textarea>
        </div>

        {{-- Tanggal Gabung --}}
        <div class="mb-4">
            <label>Tanggal Gabung</label>
            <input type="date" name="tanggal_gabung"
                   value="{{ $komunitas->tanggal_gabung }}"
                   class="w-full border rounded p-2" required>
        </div>

        {{-- Jumlah Anggota --}}
        <div class="mb-4">
            <label>Jumlah Anggota</label>
            <input type="number" name="jumlah_anggota"
                   value="{{ $komunitas->jumlah_anggota }}"
                   class="w-full border rounded p-2" required>
        </div>

        {{-- Gambar (Preview) --}}
        <div class="mb-4">
            <label>Gambar (opsional)</label>
            <input type="file" name="image" class="w-full border rounded p-2">

            {{-- Preview Gambar --}}
            @if($komunitas->image)
                <div class="mt-3">
                    <p class="text-sm text-gray-500">Gambar saat ini:</p>
                    <img src="{{ asset($komunitas->image) }}" class="w-24 mt-1 rounded">
                </div>
            @endif
        </div>

        <div class="flex gap-3">
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update
            </button>

            <a href="/admin/komunitas"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection