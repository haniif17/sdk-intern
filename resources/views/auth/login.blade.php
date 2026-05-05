<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Admin - SDK Semarang</title>

    {{-- Font Open Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Open_Sans'] bg-white h-screen flex items-center justify-center p-4">

    {{-- Kotak Utama (Warna F4F1E8) --}}
    <div class="max-w-md w-full bg-[#F4F1E8] rounded-2xl shadow-xl overflow-hidden border border-gray-200">
        
        {{-- Header Card --}}
        <div class="p-6 text-center border-b border-gray-300/50 pt-8">
            <h1 class="text-3xl font-bold text-gray-800 tracking-tight">SDK<span class="text-red-600">Admin</span></h1>
            <p class="text-gray-600 mt-2 text-sm">Masuk untuk mengelola ruang kolaborasi</p>
        </div>

        {{-- Form Container --}}
        <div class="p-8">
            
            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-700 bg-green-100 p-3 rounded-md border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-5 bg-red-100 border-l-4 border-red-500 p-4 rounded-md">
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Input Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200 shadow-sm">
                </div>

                {{-- Input Password --}}
                <div class="mb-5">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-200 shadow-sm">
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500 focus:ring-offset-0 bg-white">
                        <span class="ms-2 text-sm text-gray-600 font-medium">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-red-600 hover:text-red-800 hover:underline font-semibold transition" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- Button Login (Merah) --}}
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 shadow-md">
                    Log in
                </button>
            </form>

            {{-- Link balik ke Beranda --}}
            <div class="mt-6 text-center border-t border-gray-300/50 pt-5">
                <a href="/" class="text-sm text-gray-500 hover:text-gray-800 transition flex items-center justify-center gap-1 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</body>
</html>