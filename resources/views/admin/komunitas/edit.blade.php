@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-6">
        Edit Komunitas
    </h1>

    <form action="{{ url('/admin/komunitas/'.$komunitas->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Nama Komunitas --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Nama Komunitas
            </label>

            <input type="text"
                   name="nama_komunitas"
                   value="{{ $komunitas->nama_komunitas }}"
                   class="w-full border rounded-lg p-3"
                   required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Deskripsi
            </label>

            <textarea name="deskripsi"
                      rows="5"
                      class="w-full border rounded-lg p-3"
                      required>{{ $komunitas->deskripsi }}</textarea>
        </div>

        {{-- Tanggal Gabung --}}
        <div class="mb-4">

            <label class="block mb-2 font-semibold">
                Tanggal Gabung
            </label>

            <input type="text"
                   value="{{ $komunitas->created_at->format('d M Y') }}"
                   readonly
                   class="w-full border rounded-lg p-3 bg-gray-100 cursor-not-allowed">

        </div>

        {{-- Jumlah Anggota --}}
        <div class="mb-4">
            <label class="block mb-2 font-semibold">
                Jumlah Anggota
            </label>

            <input type="number"
                   name="jumlah_anggota"
                   value="{{ $komunitas->jumlah_anggota }}"
                   class="w-full border rounded-lg p-3"
                   required>
        </div>

        {{-- Logo --}}
        <div class="mb-6">

            <label class="block mb-2 font-semibold">
                Logo Komunitas (Opsional)
            </label>

            <input type="file"
                   name="logo"
                   class="w-full border rounded-lg p-3">

            {{-- Preview Logo --}}
            @if($komunitas->logo)

                <div class="mt-4">

                    <p class="text-sm text-gray-500 mb-2">
                        Logo Saat Ini:
                    </p>

                    <img src="{{ asset($komunitas->logo) }}"
                         class="w-28 h-28 object-cover rounded-xl border shadow-sm">

                </div>

            @endif

        </div>

        {{-- BUTTON --}}
        <div class="flex gap-3">

            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                Update
            </button>

            <a href="/admin/komunitas"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                Batal
            </a>

        </div>

    </form>

</div>

@endsection