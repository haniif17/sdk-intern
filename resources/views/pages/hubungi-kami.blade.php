@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-20">
    
    {{-- Judul --}}
    <h2 class="text-4xl font-semibold text-center mb-12 text-gray-800">
        Hubungi Kami
    </h2>

    {{-- ================= SECTION GOOGLE MAPS ================= --}}
    <div class="w-full rounded-2xl overflow-hidden shadow-lg border border-gray-200 mb-12 bg-gray-100">
        {{-- Iframe ini otomatis nyari lokasi SDK Semarang / Jl. Tri Lomba Juang --}}
        <iframe 
            src="https://maps.google.com/maps?q=Semarang%20Digital%20Kreatif%20Tri%20Lomba%20Juang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
            class="w-full h-[400px] md:h-[450px]" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    {{-- ================= SECTION 3 KOTAK INFO ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Kotak 1: Alamat --}}
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition duration-300">
            <div class="w-14 h-14 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-5">
                {{-- Ikon Map Pin --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Alamat</h3>
            <p class="text-gray-600 leading-relaxed text-sm">
                Jl. Tri Lomba Juang, Mugassari, Kec. Semarang Sel., Kota Semarang, Jawa Tengah 50249
            </p>
        </div>

        {{-- Kotak 2: Telepon --}}
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition duration-300">
            <div class="w-14 h-14 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-5">
                {{-- Ikon Telepon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Telepon</h3>
            <p class="text-gray-600 leading-relaxed text-sm mb-1">
                Dev by @syhdaana
            </p>
            {{-- Dibikin link biar bisa langsung diklik buat nelpon --}}
            <a href="tel:+628774447348" class="text-blue-600 font-medium hover:underline text-lg">
                +62 123-456-789
            </a>
        </div>

        {{-- Kotak 3: Jam Kerja --}}
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition duration-300">
            <div class="w-14 h-14 mx-auto bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mb-5">
                {{-- Ikon Jam --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Jam Kerja</h3>
            <p class="text-gray-600 leading-relaxed text-sm font-medium">
                Setiap Hari <br>
                <span class="text-lg text-gray-800 mt-1 inline-block">08:00 - 22:00</span>
            </p>
        </div>

    </div>

</div>
@endsection