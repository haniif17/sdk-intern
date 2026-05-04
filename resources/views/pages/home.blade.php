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
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                Lorem <br> Ipsum
            </h1>

            <div class="mt-4 flex space-x-3">
                <a href="/pesan-ruangan" class="bg-red-500 px-4 py-2 rounded-full text-white">
                    Pesan Ruangan
                </a>
                <a href="#" class="border border-white px-4 py-2 rounded-full text-white">
                    Detail Lengkap
                </a>
            </div>
        </div>

        {{-- BOX --}}
        <div class="absolute right-6 bottom-6 bg-white/90 backdrop-blur-md rounded-2xl p-6 w-[300px] z-30">
            <p class="text-gray-700 text-sm">
                Lorem ipsum dolor sit amet.
            </p>
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
                <div class="border-2 border-black/30 rounded-2xl p-8 min-h-[220px]
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

@endsection