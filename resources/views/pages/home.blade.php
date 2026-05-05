@extends('layouts.app')

@section('content')

@php
    $heroes = \App\Models\Hero::latest()->get();
@endphp

{{-- HERO --}}
<section class="w-full px-6 py-6">

    <div id="hero-slider" class="relative w-full aspect-[2.8/1] md:aspect-[3.2/1] overflow-hidden">

        {{-- IMAGE LOOP --}}
        @foreach($heroes as $index => $hero)
            <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out
                        {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">

                <img src="{{ asset($hero->image) }}"
                     class="w-full h-full object-cover rounded-2xl">

            </div>
        @endforeach

        {{-- DARK OVERLAY --}}
        <div class="absolute inset-0 bg-black/30 rounded-2xl z-20"></div>

        {{-- TEXT --}}
        <div class="absolute bottom-6 left-6 text-white max-w-md z-30">
            <h1 class="text-4xl md:text-5xl font-semibold leading-tight font-['Open_Sans']">
                Ruang <br>
                <span class="ml-12 md:ml-20 inline-block text-white-600">Kolaborasi</span>
            </h1>

            <div class="mt-4 flex space-x-3">
                <a href="/pesan-ruangan" class="bg-red-500 px-4 py-2 rounded-full text-white">
                    Pesan Ruangan
                </a>
                <button onclick="document.getElementById('sdkModal').classList.remove('hidden')" class="border border-white px-4 py-2 rounded-full text-white hover:bg-white hover:text-black transition duration-300">
                    Detail Lengkap
                </button>
            </div>
        </div>

        {{-- BOX --}}
        <div class="absolute right-6 bottom-6 bg-white/90 backdrop-blur-md shadow-xl rounded-2xl p-5 w-[300px] z-30 border border-white/40">
            <div class="flex items-start gap-3 mb-2">
                {{-- Ikon Pin Lokasi (Merah) --}}
                <div class="mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 text-base">Lokasi Kami</h4>
                    <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                        Kunjungi ruang kolaborasi Semarang Digital Kreatif (SDK).
                    </p>
                </div>
            </div>
            
            {{-- Tombol Link Google Maps --}}
            <a href="https://share.google/St9Mo5H90U4wAFYoz" target="_blank" 
            class="mt-4 flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200 shadow-sm">
                Buka di Google Maps
            </a>
        </div>

        {{-- BUTTONS --}}
        <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 z-40 bg-black/40 text-white px-3 py-2 rounded-full">
            ←
        </button>

        <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 z-40 bg-black/40 text-white px-3 py-2 rounded-full">
            →
        </button>

        {{-- DOTS --}}
        <div id="dots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2 z-40">
            @foreach($heroes as $index => $hero)
                <div class="dot w-3 h-3 rounded-full cursor-pointer
                    {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"></div>
            @endforeach
        </div>

    </div>

</section>


{{-- KEUNGGULAN --}}
<section class="px-6 py-10">

    <div class="w-full bg-[#F4F1E8] rounded-3xl px-4 py-6 md:px-6 md:py-6">

        {{-- TITLE --}}
        <h2 class="text-4xl md:text-5xl font-semibold mb-12 text-left">
            Keunggulan
        </h2>

        {{-- CARD --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- ITEM 1 --}}
            <div class="border-2 border-black/30 rounded-2xl p-10 min-h-[220px] shadow-sm hover:shadow-xl hover:border-black transition flex flex-col justify-start">
                
                <img src="{{ asset('images/icons/apartment.png') }}"
                    class="w-12 h-12 mb-6">

                <h3 class="text-2xl font-semibold leading-snug">
                    Tengah Kota
                </h3>

                <p class="text-base text-gray-600 mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>

            {{-- ITEM 2 --}}
            <div class="border-2 border-black/30 rounded-2xl p-10 min-h-[220px] shadow-sm hover:shadow-xl hover:border-black transition flex flex-col justify-start">
                
                <img src="{{ asset('images/icons/eco.png') }}"
                    class="w-12 h-12 mb-6">

                <h3 class="text-2xl font-semibold leading-snug">
                    Fasilitas Gratis
                </h3>

                <p class="text-base text-gray-600 mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>

            {{-- ITEM 3 --}}
            <div class="border-2 border-black/30 rounded-2xl p-10 min-h-[220px] shadow-sm hover:shadow-xl hover:border-black transition flex flex-col justify-start">
                
                <img src="{{ asset('images/icons/groups.png') }}"
                    class="w-12 h-12 mb-6">

                <h3 class="text-2xl font-semibold leading-snug">
                    Wadah Komunitas
                </h3>

                <p class="text-base text-gray-600 mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>

            {{-- ITEM 4 --}}
            <div class="border-2 border-black/30 rounded-2xl p-10 min-h-[220px] shadow-sm hover:shadow-xl hover:border-black transition flex flex-col justify-start">
                
                <img src="{{ asset('images/icons/android_wifi_3_bar.png') }}"
                    class="w-12 h-12 mb-6">

                <h3 class="text-2xl font-semibold leading-snug">
                    Internet Cepat
                </h3>

                <p class="text-base text-gray-600 mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>

        </div>

    </div>

</section>

{{-- FASILITAS --}}
<section class="px-6 py-12">

    <div class="max-w-7xl mx-auto">

        {{-- TITLE --}}
        <h2 class="text-4xl md:text-5xl font-semibold text-center mb-10">
            Fasilitas
        </h2>

        {{-- LIST --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            @foreach($fasilitas as $item)
                <div onclick="openModal(
                        '{{ asset($item->image) }}',
                        '{{ addslashes($item->title) }}',
                        `{{ addslashes($item->description) }}`
                    )"
                    class="cursor-pointer border-2 border-black/30 rounded-2xl p-8 min-h-[220px]
                        shadow-sm hover:shadow-xl hover:border-black
                        transition-all duration-300 ease-out">

                    <img src="{{ asset($item->image) }}"
                        class="w-full h-[150px] object-cover rounded-2xl mb-4">

                    <h3 class="text-lg font-semibold text-center">
                        {{ $item->title }}
                    </h3>

                    <p class="text-sm text-gray-600 text-center mt-2">
                        {{ $item->description }}
                    </p>
                </div>
            @endforeach

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-center mt-10">
            <a href="/fasilitas"
               class="bg-red-500 text-white px-6 py-3 rounded-full text-lg font-semibold hover:bg-red-600 transition">
                Lihat Semua
            </a>
        </div>

    </div>

</section>

{{-- INFOGRAFIS --}}
<section class="px-6 py-12">

    <div class="max-w-7xl mx-auto">

        <div class="w-full aspect-[3/1] rounded-3xl overflow-hidden">

            <img src="{{ asset('images/fasilitas/infografis.png') }}"
                 class="w-full h-full object-cover">

        </div>

    </div>

</section>

{{-- Kegiatan Terbaru --}}
<section class="px-6 py-12">

    <div class="max-w-7xl mx-auto">

        {{-- TITLE --}}
        <h2 class="text-4xl font-semibold mb-10 text-center">
            Kegiatan Terbaru
        </h2>

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            @foreach($kegiatans as $kegiatan)
                <div onclick="openModal(
                        '{{ asset($kegiatan->image) }}',
                        '{{ addslashes($kegiatan->nama_kegiatan) }}',
                        `{{ addslashes($kegiatan->deskripsi) }}`,
                        'Tanggal: {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format("d M Y") }}'
                    )"
                    class="relative group cursor-pointer rounded-3xl overflow-hidden">

                    {{-- IMAGE --}}
                    <img src="{{ asset($kegiatan->image) }}"
                        class="w-full h-[350px] object-cover transition-transform duration-500 group-hover:scale-105">

                    {{-- GRADIENT OVERLAY --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                    {{-- CONTENT --}}
                    <div class="absolute bottom-6 left-6 right-6 text-white">

                        {{-- DATE --}}
                        <p class="text-sm opacity-80 mb-1">
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                        </p>

                        {{-- TITLE --}}
                        <h3 class="text-2xl font-semibold leading-snug">
                            {{ $kegiatan->nama_kegiatan }}
                        </h3>

                        {{-- DESC --}}
                        <p class="text-sm mt-2 opacity-90">
                            {{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 80) }}
                        </p>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</section>

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const slider = document.getElementById('hero-slider');

    if (slides.length <= 1) return;

    let current = 0;
    let interval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('opacity-100', 'z-10');
            slide.classList.add('opacity-0', 'z-0');

            dots[i].classList.remove('bg-white');
            dots[i].classList.add('bg-white/50');
        });

        slides[index].classList.remove('opacity-0', 'z-0');
        slides[index].classList.add('opacity-100', 'z-10');

        dots[index].classList.remove('bg-white/50');
        dots[index].classList.add('bg-white');

        current = index;
    }

    function nextSlide() {
        let next = (current + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        let prev = (current - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    function startSlider() {
        interval = setInterval(nextSlide, 3000);
    }

    function stopSlider() {
        clearInterval(interval);
    }

    // events
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });

    slider.addEventListener('mouseenter', stopSlider);
    slider.addEventListener('mouseleave', startSlider);

    startSlider();
});
</script>

{{-- MODAL --}}
<div id="modal"
    onclick="closeModal(event)"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 max-w-lg w-full relative mx-4"
        onclick="event.stopPropagation()">

        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-xl font-bold">
            ✕
        </button>

        <img id="modalImage" class="w-full h-56 object-cover rounded-lg mb-4">

        <h3 id="modalTitle" class="text-xl font-semibold text-center mb-2"></h3>

        <p id="modalDesc" class="text-center text-gray-600"></p>

        <p id="modalExtra" class="text-sm text-gray-500 text-center mt-2"></p>
    </div>
</div>

<script>
function openModal(image, title, desc, extra = '') {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modal').classList.add('flex');

    document.getElementById('modalImage').src = image;
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDesc').innerText = desc;
    document.getElementById('modalExtra').innerText = extra;

    document.body.classList.add('overflow-hidden');
}

function closeModal(event = null) {
    if (event && event.target !== document.getElementById('modal')) return;

    document.getElementById('modal').classList.add('hidden');
    document.getElementById('modal').classList.remove('flex');

    document.body.classList.remove('overflow-hidden');
}

document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeModal();
});
</script>

<!-- ================= POPUP MODAL SDK ================= -->
<div id="sdkModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-60 flex items-center justify-center p-4 transition-opacity">
    <!-- Konten Modal -->
    <div class="bg-white rounded-xl shadow-2xl max-w-lg w-full p-6 relative transform transition-all">
        
        <!-- Tombol X (Tutup) di pojok kanan atas -->
        <button onclick="document.getElementById('sdkModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Judul Popup -->
        <h3 class="text-2xl font-semibold mb-3 text-gray-800 border-b pb-2">
            Tentang SDK
        </h3>

        <!-- Isi Teks (Sesuai Brief Lu) -->
        <p class="text-gray-600 leading-relaxed text-justify mt-4">
            Semarang Digital Kreatif (SDK) adalah coworking space dan pusat komunitas digital yang diinisiasi oleh Pemerintah Kota Semarang bersama mitra (seperti Telkom/Indigospace) untuk memfasilitasi komunitas kreatif dan IT. Diresmikan pada 2016, SDK menyediakan ruang kerja gratis, fasilitas internet, dan ruang pertemuan untuk berkolaborasi serta mengembangkan konten digital di Semarang.
        </p>
        
        <!-- Tombol Tutup di Bawah -->
        <div class="mt-6 flex justify-end">
            <button onclick="document.getElementById('sdkModal').classList.add('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg transition duration-200">
                Tutup
            </button>
        </div>
        
    </div>
</div>

@endsection