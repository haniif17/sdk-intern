@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">
    
    {{-- ================= BANNER WELCOME (Tema Baru: F4F1E8) ================= --}}
    <div class="bg-[#F4F1E8] border border-gray-200 rounded-3xl p-8 mb-10 shadow-sm flex items-center justify-between">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 tracking-tight">
                Halo, Admin! 👋
            </h1>
            <p class="text-gray-600 text-lg">
                Selamat datang di Control Panel SDK Semarang. Pilih menu di bawah untuk mulai mengelola sistem.
            </p>
        </div>
        {{-- Ilustrasi tipis-tipis di kanan --}}
        <div class="hidden md:block opacity-50 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
    </div>

    {{-- ================= GRID MENU QUICK ACCESS ================= --}}
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Menu Utama</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- 1. Card Komunitas --}}
        <a href="/admin/komunitas" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-200 hover:-translate-y-1 transition duration-300 group block relative overflow-hidden">
            <div class="w-12 h-12 bg-[#F4F1E8] text-red-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-red-50 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-red-600 transition">Data Komunitas</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola daftar komunitas kreatif.</p>
        </a>

        {{-- 2. Card Kegiatan --}}
        <a href="/admin/kegiatan" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-200 hover:-translate-y-1 transition duration-300 group block relative overflow-hidden">
            <div class="w-12 h-12 bg-[#F4F1E8] text-red-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-red-50 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-red-600 transition">Data Kegiatan</h3>
            <p class="text-sm text-gray-500 mt-1">Tambah atau edit event/kegiatan.</p>
        </a>

        {{-- 3. Card Fasilitas --}}
        <a href="/admin/fasilitas" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-200 hover:-translate-y-1 transition duration-300 group block relative overflow-hidden">
            <div class="w-12 h-12 bg-[#F4F1E8] text-red-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-red-50 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-red-600 transition">Data Fasilitas</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola fasilitas ruangan SDK.</p>
        </a>

        {{-- 4. Card Booking --}}
        <a href="{{ route('admin.booking.index') }}" class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-200 hover:-translate-y-1 transition duration-300 group block relative overflow-hidden">
            <div class="w-12 h-12 bg-[#F4F1E8] text-red-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-red-50 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 group-hover:text-red-600 transition">Pesan Ruangan</h3>
            <p class="text-sm text-gray-500 mt-1">Approve/Reject jadwal booking.</p>
        </a>

    </div>

</div>

@endsection