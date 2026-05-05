<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SDK Admin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts (Otomatis load Tailwind & Alpine.js bawaan Laravel) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            
            {{-- ================= NAVBAR KHUSUS ADMIN ================= --}}
            {{-- Pakai x-data dari Alpine.js bawaan Laravel buat buka-tutup menu di HP --}}
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            
                            <!-- Logo / Nama Brand -->
                            <div class="shrink-0 flex items-center">
                                <a href="/admin" class="text-2xl font-extrabold text-red-600 tracking-tight">
                                    SDK<span class="text-gray-800">Admin</span>
                                </a>
                            </div>

                            <!-- Link Menu (Desktop) -->
                            <div class="hidden sm:-my-px sm:ml-10 sm:flex sm:space-x-8">
                                <a href="/admin" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-blue-500 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    Dashboard
                                </a>
                                <a href="/admin/komunitas" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-blue-500 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    Komunitas
                                </a>
                                <a href="/admin/kegiatan" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-blue-500 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    Kegiatan
                                </a>
                                <a href="/admin/fasilitas" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-blue-500 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    Fasilitas
                                </a>
                                <a href="{{ route('admin.booking.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-blue-500 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                    Pesan Ruangan
                                </a>
                            </div>
                        </div>

                        <!-- Tombol Logout (Desktop) -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 px-4 py-2 rounded-md text-sm font-medium transition">
                                    Logout
                                </button>
                            </form>
                        </div>

                        <!-- Hamburger Menu (Mobile) -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Menu Dropdown (Mobile) -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-200 shadow-md absolute w-full">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="/admin/dashboard" class="block pl-4 pr-4 py-3 border-l-4 border-transparent hover:border-blue-500 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition">Dashboard</a>
                        <a href="/admin/komunitas" class="block pl-4 pr-4 py-3 border-l-4 border-transparent hover:border-blue-500 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition">Komunitas</a>
                        <a href="/admin/kegiatan" class="block pl-4 pr-4 py-3 border-l-4 border-transparent hover:border-blue-500 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition">Kegiatan</a>
                        <a href="/admin/fasilitas" class="block pl-4 pr-4 py-3 border-l-4 border-transparent hover:border-blue-500 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition">Fasilitas</a>
                        <a href="{{ route('admin.booking.index') }}" class="block pl-4 pr-4 py-3 border-l-4 border-transparent hover:border-blue-500 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 transition">Pesan Ruangan</a>
                    </div>
                    <div class="pt-2 pb-4 border-t border-gray-200">
                        <form method="POST" action="{{ route('logout') }}" class="pl-4 pr-4">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 font-medium text-red-600 hover:text-red-800">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

            <!-- Page Heading (Opsional kalau lu mau pake slot header) -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Konten Utama -->
            <main>
                @yield('content')
            </main>
            
        </div>
    </body>
</html>