@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
    
    {{-- Decorative Background Element --}}
    <div class="absolute top-0 left-0 w-full h-64 bg-red-600 -z-10 clip-path-slant"></div>

    <h2 class="text-4xl font-semibold text-center mb-10">
            Daftar Komunitas 
    </h2>

    <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
        <div class="bg-white/95 backdrop-blur-sm py-10 px-8 md:px-12 shadow-[0_20px_50px_rgba(0,0,0,0.1)] rounded-[2.5rem] border border-white/20">
            
            <form action="{{ route('komunitas.register') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-1">
                    <h3 class="text-xl font-bold text-gray-800 border-b-2 border-red-600 inline-block mb-4">Profil Komunitas</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Komunitas --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 ml-1">Nama Komunitas</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl transition duration-200 shadow-sm"
                                placeholder="Contoh: Semarang Dev">
                            @error('name') <p class="text-red-600 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Username --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 ml-1">Username / ID</label>
                            <input type="text" name="username" value="{{ old('username') }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl transition duration-200 shadow-sm"
                                placeholder="semarang_dev">
                            @error('username') <p class="text-red-600 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    {{-- Nama Ketua --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 ml-1">Nama Ketua</label>
                        <input type="text" name="nama_ketua" value="{{ old('nama_ketua') }}" required 
                            class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl transition duration-200 shadow-sm">
                        @error('nama_ketua') <p class="text-red-600 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
                    </div>

                    {{-- Jumlah Anggota --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 ml-1">Jumlah Anggota</label>
                        <div class="relative">
                            <input type="number" name="jumlah_anggota" value="{{ old('jumlah_anggota') }}" required 
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl transition duration-200 shadow-sm">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm italic">Orang</span>
                        </div>
                        @error('jumlah_anggota') <p class="text-red-600 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 ml-1">Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl transition duration-200 shadow-sm"
                        placeholder="komunitas@example.com">
                    @error('email') <p class="text-red-600 text-xs mt-1 ml-2">{{ $message }}</p> @enderror
                </div>

                {{-- Logo Komunitas --}}
                <div class="bg-red-50 p-6 rounded-3xl border-2 border-dashed border-red-200">
                    <label class="block text-sm font-bold text-red-700 mb-2 text-center">Upload Logo Komunitas</label>
                    <input type="file" name="logo" accept="image/*"
                        class="block w-full text-sm text-gray-500 
                        file:mr-4 file:py-2 file:px-6 
                        file:rounded-full file:border-0 
                        file:text-sm file:font-bold 
                        file:bg-red-600 file:text-white 
                        hover:file:bg-red-700 file:cursor-pointer transition">
                    <p class="text-center text-[10px] text-red-400 mt-2 italic">*Format: JPG, PNG (Max. 2MB)</p>
                    @error('logo') <p class="text-red-600 text-xs mt-1 text-center">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-4 pt-4">
                    <h3 class="text-xl font-bold text-gray-800 border-b-2 border-red-600 inline-block">Keamanan Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 ml-1">Password</label>
                            <input type="password" name="password" required 
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl shadow-sm">
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 ml-1">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required 
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border-transparent focus:border-red-500 focus:bg-white focus:ring-0 rounded-2xl shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-4 px-4 border border-transparent rounded-2xl text-lg font-black text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1 shadow-lg hover:shadow-red-500/40">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-red-300 group-hover:text-red-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        SUBMIT DATA KOMUNITAS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .clip-path-slant {
        clip-path: polygon(0 0, 100% 0, 100% 70%, 0% 100%);
    }
</style>
@endsection