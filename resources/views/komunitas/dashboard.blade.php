@extends('layouts.app')

@section('content')
{{-- Ambil data komunitas milik user yang sedang login --}}
@php
    $komunitas = \App\Models\Komunitas::where('user_id', Auth::id())->first();
@endphp

<div class="min-h-screen bg-slate-50 py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Dashboard --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Komunitas</h1>
            <p class="text-gray-600 mt-1">Selamat datang, {{ Auth::user()->name }}!</p>
        </div>

        @if($komunitas)
            {{-- BANNER STATUS --}}
            @if($komunitas->status === 'pending')
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-r-xl shadow-sm mb-8 flex items-start">
                    <svg class="w-6 h-6 text-yellow-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="text-lg font-bold text-yellow-800">Menunggu Verifikasi Admin</h3>
                        <p class="text-yellow-700 mt-1">Pendaftaran komunitas lu sedang ditinjau oleh Admin. Fitur pengisian deskripsi dan profil lengkap akan terbuka otomatis setelah disetujui.</p>
                    </div>
                </div>
            @elseif($komunitas->status === 'rejected')
                <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-xl shadow-sm mb-8 flex items-start">
                    <svg class="w-6 h-6 text-red-500 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="text-lg font-bold text-red-800">Pendaftaran Ditolak</h3>
                        <p class="text-red-700 mt-1">Mohon maaf, pendaftaran komunitas Anda tidak dapat kami setujui saat ini. Silakan hubungi admin untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            @endif

            {{-- PROFIL CARD --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start gap-6">
                    {{-- Logo --}}
                    <div class="w-24 h-24 md:w-32 md:h-32 flex-shrink-0 rounded-2xl overflow-hidden border-4 border-gray-50 shadow-md">
                        @if($komunitas->logo)
                            <img src="{{ asset($komunitas->logo) }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 font-bold text-xs text-center p-2">NO LOGO</div>
                        @endif
                    </div>
                    
                    {{-- Info Singkat --}}
                    <div class="flex-1 text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                            <h2 class="text-2xl font-black text-gray-800">{{ $komunitas->nama_komunitas }}</h2>
                            @if($komunitas->status === 'approved')
                                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Verified
                                </span>
                            @endif
                        </div>
                        <p class="text-gray-500 font-medium mb-4">{{ '@' . $komunitas->username }} | {{ $komunitas->email }}</p>
                        
                        <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-2xl">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Ketua Komunitas</p>
                                <p class="text-gray-800 font-semibold">{{ $komunitas->nama_ketua }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold">Jumlah Anggota</p>
                                <p class="text-gray-800 font-semibold">{{ $komunitas->jumlah_anggota }} Orang</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- JIKA APPROVED: BUKA FORM DESKRIPSI --}}
            @if($komunitas->status === 'approved')
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-xl font-bold text-gray-800">Lengkapi Profil Komunitas</h3>
                        <p class="text-sm text-gray-500 mt-1">Ceritakan tentang komunitas lu agar lebih menarik di halaman publik.</p>
                    </div>

                    {{-- Form Nanti diarahkan ke Controller untuk update deskripsi --}}
                    <form action="{{ route('komunitas.update-deskripsi') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Lengkap</label>
                            <textarea name="deskripsi" rows="5" required
                                class="w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl shadow-sm transition"
                                placeholder="Jelaskan visi, misi, atau kegiatan rutin komunitas kalian di sini...">{{ old('deskripsi', $komunitas->deskripsi) }}</textarea>
                        </div>

                        <button type="submit" class="w-full md:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Simpan Deskripsi
                        </button>
                    </form>
                </div>
            @endif

        @else
            <div class="bg-red-50 text-red-500 p-6 rounded-xl">
                Data komunitas tidak ditemukan.
            </div>
        @endif

    </div>
</div>
@endsection