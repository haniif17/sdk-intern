@extends('layouts.app')

@section('content')

@php
    // --- PENYESUAIAN PATH: Sekarang bener nembak ke public/hero/ ---
    $heroes = [
        (object)[ 'image' => 'images/hero/banner1.png' ],
        (object)[ 'image' => 'images/hero/banner2.jpg' ],
        (object)[ 'image' => 'images/hero/banner3.jpg' ],
    ];
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap');

    .sdk-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    .sdk-display { font-family: 'Playfair Display', serif; }

    /* HERO */
    .hero-slide { position: absolute; inset: 0; transition: opacity 0.8s cubic-bezier(.4,0,.2,1); }
    .hero-img { width: 100%; height: 100%; object-fit: cover; border-radius: 24px; }

    /* Info boxes */
    .info-box {
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.6);
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .info-box:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(0,0,0,0.18); }

    /* Keunggulan cards */
    .unggulan-card {
        background: #fff;
        border: 1.5px solid rgba(0,0,0,0.08);
        border-radius: 20px;
        padding: 28px;
        transition: all 0.3s cubic-bezier(.4,0,.2,1);
        position: relative;
        overflow: hidden;
    }
    .unggulan-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #dc2626, #ef4444);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
        border-radius: 20px 20px 0 0;
    }
    .unggulan-card:hover::before { transform: scaleX(1); }
    .unggulan-card:hover {
        border-color: rgba(220,38,38,0.2);
        box-shadow: 0 12px 40px rgba(220,38,38,0.1), 0 4px 16px rgba(0,0,0,0.06);
        transform: translateY(-4px);
    }
    .unggulan-icon-wrap {
        width: 52px; height: 52px;
        background: #FEF2F2;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 18px;
        transition: background 0.3s ease;
    }
    .unggulan-card:hover .unggulan-icon-wrap { background: #dc2626; }
    .unggulan-card:hover .unggulan-icon-wrap svg { stroke: #fff; }

    /* Fasilitas cards */
    .fasilitas-card {
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1.5px solid rgba(0,0,0,0.08);
        transition: all 0.35s cubic-bezier(.4,0,.2,1);
        cursor: pointer;
    }
    .fasilitas-card:hover {
        border-color: rgba(220,38,38,0.25);
        box-shadow: 0 20px 50px rgba(0,0,0,0.13);
        transform: translateY(-6px);
    }
    .fasilitas-card img {
        width: 100%; height: 170px; object-fit: cover;
        transition: transform 0.5s ease;
    }
    .fasilitas-card:hover img { transform: scale(1.06); }
    .fasilitas-card-body { padding: 20px; }

    /* Kegiatan cards */
    .kegiatan-card {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
    }
    .kegiatan-card img {
        width: 100%; height: 360px; object-fit: cover;
        transition: transform 0.6s cubic-bezier(.4,0,.2,1);
    }
    .kegiatan-card:hover img { transform: scale(1.05); }
    .kegiatan-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.2) 55%, transparent 100%);
        transition: background 0.3s ease;
    }
    .kegiatan-card:hover .kegiatan-overlay {
        background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);
    }
    .kegiatan-content {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 28px;
        transform: translateY(4px);
        transition: transform 0.3s ease;
    }
    .kegiatan-card:hover .kegiatan-content { transform: translateY(0); }

    /* Date badge */
    .date-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(220,38,38,0.85);
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 12px; font-weight: 600;
        color: #fff; letter-spacing: 0.3px;
        margin-bottom: 10px;
        backdrop-filter: blur(4px);
    }

    /* Slider nav */
    .slider-btn {
        position: absolute; top: 50%; z-index: 40;
        transform: translateY(-50%);
        width: 42px; height: 42px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,0.35);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; cursor: pointer;
        transition: all 0.25s ease;
    }
    .slider-btn:hover { background: rgba(255,255,255,0.35); transform: translateY(-50%) scale(1.08); }

    /* Dots */
    .dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer; transition: all 0.3s ease;
    }
    .dot.active { background: #fff; width: 24px; border-radius: 4px; }

    /* Section titles */
    .section-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        color: #dc2626; font-size: 13px; font-weight: 700;
        letter-spacing: 1.2px; text-transform: uppercase;
        margin-bottom: 10px;
    }
    .section-eyebrow::before {
        content: ''; display: block;
        width: 24px; height: 2px; background: #dc2626; border-radius: 2px;
    }

    /* Red button */
    .btn-red {
        display: inline-flex; align-items: center; gap: 8px;
        background: #dc2626; color: #fff;
        padding: 11px 24px; border-radius: 50px;
        font-weight: 600; font-size: 14px;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 15px rgba(220,38,38,0.3);
    }
    .btn-red:hover {
        background: #b91c1c;
        box-shadow: 0 6px 20px rgba(220,38,38,0.4);
        transform: translateY(-1px); color: #fff;
    }
    .btn-outline-white {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent;
        border: 2px solid rgba(255,255,255,0.75);
        color: #fff; padding: 9px 22px; border-radius: 50px;
        font-weight: 600; font-size: 14px; text-decoration: none;
        transition: all 0.25s ease;
    }
    .btn-outline-white:hover { background: #fff; color: #111; border-color: #fff; }

    /* Infografis */
    .infografis-wrap {
        border-radius: 24px; overflow: hidden;
        box-shadow: 0 8px 40px rgba(0,0,0,0.1);
        position: relative;
    }

    /* Modal */
    .modal-card {
        background: #fff; border-radius: 24px;
        padding: 0; overflow: hidden;
        max-width: 480px; width: 100%;
        position: relative; margin: 16px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.25);
        animation: modalIn 0.3s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.92) translateY(12px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* SDK popup */
    .sdk-modal-card {
        background: #fff; border-radius: 24px;
        max-width: 460px; width: 100%; margin: 16px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.25);
        overflow: hidden;
        animation: modalIn 0.3s cubic-bezier(.34,1.56,.64,1);
    }

    /* Keunggulan bg */
    .keunggulan-bg {
        background: linear-gradient(135deg, #FDF6EC 0%, #F4EFE4 100%);
        border-radius: 28px; padding: 48px;
        position: relative; overflow: hidden;
    }
    .keunggulan-bg::after {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(220,38,38,0.05);
    }
</style>

{{-- HERO --}}
<section class="w-full px-4 md:px-6 py-5 sdk-font">

    <div id="hero-slider" class="relative w-full overflow-hidden" style="aspect-ratio: 2.8/1; border-radius: 24px; min-height: 280px; max-height: 600px;">

        {{-- IMAGE LOOP --}}
        @foreach($heroes as $index => $hero)
            <div class="hero-slide {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" style="z-index: {{ $index === 0 ? 10 : 0 }}; transition: opacity 0.8s cubic-bezier(.4,0,.2,1);">
                <img src="{{ asset($hero->image) }}" class="hero-img" alt="Hero {{ $index + 1 }}">
            </div>
        @endforeach

        {{-- OVERLAY --}}
        <div class="absolute inset-0 z-20" style="background: linear-gradient(135deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.15) 60%, transparent 100%); border-radius: 24px;"></div>

        {{-- TEXT & BUTTONS --}}
        <div class="absolute z-30" style="bottom: 36px; left: 36px; max-width: 480px;">

            <p class="section-eyebrow" style="color: rgba(255,255,255,0.8); border-color: rgba(255,255,255,0.6);">
                <span style="width:20px;height:2px;background:rgba(255,255,255,0.7);border-radius:2px;display:inline-block;"></span>
                Semarang Digital Kreatif
            </p>

            <h1 class="sdk-display text-white" style="font-size: clamp(2rem, 5vw, 3.2rem); line-height: 1.15; font-weight: 700; margin-bottom: 22px; text-shadow: 0 2px 12px rgba(0,0,0,0.3);">
                Ruang<br>
                <span style="padding-left: clamp(2rem, 6vw, 5rem);">Kolaborasi</span>
            </h1>

            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <a href="/pesan-ruangan" class="btn-red">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Pesan Ruangan
                </a>
                <a href="https://forms.gle/LPCQARYp8x8RJX7Y9" target="_blank" class="btn-red">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Daftar Tamu
                </a>
                <button onclick="document.getElementById('sdkModal').classList.remove('hidden')" class="btn-outline-white">
                    Detail Lengkap
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </button>
            </div>

        </div>

        {{-- BOX DAFTAR KOMUNITAS --}}
        <div class="hidden md:block info-box absolute z-30" style="right: 24px; bottom: 220px; width: 280px; padding: 20px;">
            <div style="display:flex; align-items:flex-start; gap:12px; margin-bottom:14px;">
                <div style="width:38px;height:38px;border-radius:10px;background:#FEF2F2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;color:#dc2626;stroke:#dc2626;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h4 style="font-weight:700;font-size:13px;color:#111;letter-spacing:0.5px;text-transform:uppercase;margin-bottom:4px;">Ayo Daftar!</h4>
                    <p style="font-size:12.5px;color:#555;line-height:1.5;margin:0;">Daftarkan komunitas Anda di Semarang Digital Kreatif (SDK).</p>
                </div>
            </div>
            <a href="{{ route('komunitas.register') }}" class="btn-red" style="width:100%;justify-content:center;font-size:13px;padding:9px 16px;">
                Daftar Komunitas
            </a>
        </div>

        {{-- BOX LOKASI --}}
        <div class="hidden md:block info-box absolute z-30" style="right: 24px; bottom: 24px; width: 280px; padding: 20px;">
            <div style="display:flex; align-items:flex-start; gap:12px; margin-bottom:14px;">
                <div style="width:38px;height:38px;border-radius:10px;background:#FEF2F2;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;height:20px;stroke:#dc2626;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h4 style="font-weight:700;font-size:13px;color:#111;letter-spacing:0.5px;margin-bottom:4px;">Lokasi Kami</h4>
                    <p style="font-size:12.5px;color:#555;line-height:1.5;margin:0;">Kunjungi ruang kolaborasi Semarang Digital Kreatif (SDK).</p>
                </div>
            </div>
            <a href="https://share.google/St9Mo5H90U4wAFYoz" target="_blank" class="btn-red" style="width:100%;justify-content:center;font-size:13px;padding:9px 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                Buka di Google Maps
            </a>
        </div>

        {{-- NAVIGATION ARROWS --}}
        <button id="prevBtn" class="slider-btn" style="left: 16px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:18px;height:18px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>
        <button id="nextBtn" class="slider-btn" style="right: 16px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:18px;height:18px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </button>

        {{-- DOTS --}}
        <div id="dots" class="absolute z-40" style="bottom: 16px; left: 50%; transform: translateX(-50%); display:flex; gap:6px; align-items:center;">
            @foreach($heroes as $index => $hero)
                <div class="dot {{ $index === 0 ? 'active' : '' }}"></div>
            @endforeach
        </div>

    </div>

</section>


{{-- KEUNGGULAN --}}
<section class="sdk-font" style="max-width: 1280px; margin: 0 auto; padding: 8px 24px 40px;">

    <div class="keunggulan-bg">

        <div style="margin-bottom: 32px;">
            <p class="section-eyebrow">Mengapa Kami</p>
            <h2 style="font-size: clamp(1.7rem,3.5vw,2.4rem); font-weight: 700; color: #111; margin: 0;">Keunggulan</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 18px;">

            {{-- 1 --}}
            <div class="unggulan-card">
                <div class="unggulan-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:26px;height:26px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#111;margin-bottom:8px;">Tengah Kota</h3>
                <p style="font-size:13.5px;color:#666;line-height:1.6;margin:0;">Lokasi strategis di pusat Kota Semarang (Tri Lomba Juang), sangat mudah diakses dari berbagai arah.</p>
            </div>

            {{-- 2 --}}
            <div class="unggulan-card">
                <div class="unggulan-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:26px;height:26px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09l2.846.813-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                    </svg>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#111;margin-bottom:8px;">Fasilitas Gratis</h3>
                <p style="font-size:13.5px;color:#666;line-height:1.6;margin:0;">Nikmati ruang kerja, proyektor, dan berbagai fasilitas pendukung lainnya tanpa dipungut biaya.</p>
            </div>

            {{-- 3 --}}
            <div class="unggulan-card">
                <div class="unggulan-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:26px;height:26px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#111;margin-bottom:8px;">Wadah Komunitas</h3>
                <p style="font-size:13.5px;color:#666;line-height:1.6;margin:0;">Ruang kolaborasi ideal untuk menghubungkan berbagai komunitas kreatif, startup, dan pegiat IT.</p>
            </div>

            {{-- 4 --}}
            <div class="unggulan-card">
                <div class="unggulan-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#dc2626" style="width:26px;height:26px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                    </svg>
                </div>
                <h3 style="font-size:16px;font-weight:700;color:#111;margin-bottom:8px;">Internet Cepat</h3>
                <p style="font-size:13.5px;color:#666;line-height:1.6;margin:0;">Koneksi Wi-Fi berkecepatan tinggi dan stabil untuk menjamin kelancaran aktivitas digital Anda.</p>
            </div>

        </div>

    </div>

</section>


{{-- FASILITAS --}}
<section class="sdk-font" style="padding: 16px 24px 48px; max-width: 1280px; margin: 0 auto;">

    <div style="text-align:center; margin-bottom: 36px;">
        <p class="section-eyebrow" style="justify-content:center;">Apa yang Kami Sediakan</p>
        <h2 style="font-size: clamp(1.8rem,4vw,2.8rem); font-weight: 700; color: #111; margin: 0;">Fasilitas</h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
        @foreach($fasilitas as $item)
            <div class="fasilitas-card" onclick="openModal(
                    '{{ asset($item->image) }}',
                    '{{ addslashes($item->title) }}',
                    `{{ addslashes($item->description) }}`
                )">
                <div style="overflow:hidden;">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                </div>
                <div class="fasilitas-card-body">
                    <h3 style="font-size:15px;font-weight:700;color:#111;text-align:center;margin-bottom:6px;">{{ $item->title }}</h3>
                    <p style="font-size:13px;color:#777;text-align:center;margin:0;line-height:1.55;">{{ $item->description }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div style="text-align:center; margin-top: 36px;">
        <a href="/fasilitas" class="btn-red" style="font-size:15px; padding: 13px 32px;">
            Lihat Semua Fasilitas
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </a>
    </div>

</section>


{{-- INFOGRAFIS --}}
<section class="sdk-font" style="padding: 0 24px 56px; max-width: 1280px; margin: 0 auto;">
    <div class="infografis-wrap">
        <img src="{{ asset('images/fasilitas/infografis.png') }}" style="width:100%; height:auto; display:block;" alt="Infografis SDK">
    </div>
</section>


{{-- KEGIATAN TERBARU --}}
<section class="sdk-font" style="padding: 0 24px 64px; max-width: 1280px; margin: 0 auto;">

    <div style="text-align:center; margin-bottom: 36px;">
        <p class="section-eyebrow" style="justify-content:center;">Apa yang Terjadi</p>
        <h2 style="font-size: clamp(1.8rem,4vw,2.8rem); font-weight: 700; color: #111; margin: 0;">Kegiatan Terbaru</h2>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
        @foreach($kegiatans as $kegiatan)
            <div class="kegiatan-card" onclick="openModal(
                    '{{ asset($kegiatan->image) }}',
                    '{{ addslashes($kegiatan->nama_kegiatan) }}',
                    `{{ addslashes($kegiatan->deskripsi) }}`,
                    'Tanggal: {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format("d M Y") }}'
                )">
                <img src="{{ asset($kegiatan->image) }}" alt="{{ $kegiatan->nama_kegiatan }}">
                <div class="kegiatan-overlay"></div>
                <div class="kegiatan-content">
                    <span class="date-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                    </span>
                    <h3 style="font-size:clamp(1.1rem,2.5vw,1.4rem);font-weight:700;color:#fff;margin:0 0 8px;line-height:1.3;">
                        {{ $kegiatan->nama_kegiatan }}
                    </h3>
                    <p style="font-size:13.5px;color:rgba(255,255,255,0.82);margin:0;line-height:1.55;">
                        {{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 80) }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

</section>


{{-- SLIDER SCRIPT --}}
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
            slide.style.opacity = '0';
            slide.style.zIndex = '0';
            dots[i].classList.remove('active');
            dots[i].style.background = 'rgba(255,255,255,0.4)';
            dots[i].style.width = '8px';
            dots[i].style.borderRadius = '50%';
        });

        slides[index].style.opacity = '1';
        slides[index].style.zIndex = '10';
        dots[index].classList.add('active');
        dots[index].style.background = '#fff';
        dots[index].style.width = '24px';
        dots[index].style.borderRadius = '4px';

        current = index;
    }

    function nextSlide() { showSlide((current + 1) % slides.length); }
    function prevSlide() { showSlide((current - 1 + slides.length) % slides.length); }

    // --- TIME CONFIGURATION: Tetap 1 detik (1000ms) ---
    function startSlider() { interval = setInterval(nextSlide, 2500); }
    function stopSlider() { clearInterval(interval); }

    nextBtn.addEventListener('click', () => { stopSlider(); nextSlide(); startSlider(); });
    prevBtn.addEventListener('click', () => { stopSlider(); prevSlide(); startSlider(); });

    dots.forEach((dot, i) => dot.addEventListener('click', () => { stopSlider(); showSlide(i); startSlider(); }));

    slider.addEventListener('mouseenter', stopSlider);
    slider.addEventListener('mouseleave', startSlider);

    startSlider();
});
</script>


{{-- MODAL FASILITAS/KEGIATAN --}}
<div id="modal" onclick="closeModal(event)"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:50;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(4px);">

    <div class="modal-card" onclick="event.stopPropagation()">

        <div style="position:relative;">
            <img id="modalImage" style="width:100%;height:220px;object-fit:cover;" alt="">
            <button onclick="closeModal()"
                style="position:absolute;top:12px;right:12px;width:34px;height:34px;border-radius:50%;background:rgba(0,0,0,0.5);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div style="padding:24px;">
            <h3 id="modalTitle" style="font-size:18px;font-weight:700;color:#111;text-align:center;margin:0 0 10px;font-family:'Plus Jakarta Sans',sans-serif;"></h3>
            <p id="modalDesc" style="font-size:14px;color:#555;text-align:center;line-height:1.6;margin:0;font-family:'Plus Jakarta Sans',sans-serif;"></p>
            <p id="modalExtra" style="font-size:13px;color:#dc2626;text-align:center;margin:10px 0 0;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;"></p>
        </div>

    </div>
</div>

<script>
function openModal(image, title, desc, extra = '') {
    const m = document.getElementById('modal');
    m.style.display = 'flex';
    document.getElementById('modalImage').src = image;
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDesc').innerText = desc;
    document.getElementById('modalExtra').innerText = extra;
    document.body.style.overflow = 'hidden';
}
function closeModal(event = null) {
    if (event && event.target !== document.getElementById('modal')) return;
    document.getElementById('modal').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { document.getElementById('modal').style.display = 'none'; document.body.style.overflow = ''; } });
</script>


{{-- POPUP MODAL SDK --}}
<div id="sdkModal" onclick="if(event.target===this){this.classList.add('hidden');}"
    class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center p-4"
    style="backdrop-filter:blur(5px);">

    <div class="sdk-modal-card sdk-font" onclick="event.stopPropagation()">

        {{-- Header strip --}}
        <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);padding:28px 28px 24px;position:relative;">
            <div style="width:42px;height:42px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            </div>
            <h3 style="color:#fff;font-size:20px;font-weight:700;margin:0;">Tentang SDK</h3>
            <button onclick="document.getElementById('sdkModal').classList.add('hidden')"
                style="position:absolute;top:16px;right:16px;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.2);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div style="padding:28px;">
            <p style="font-size:14.5px;color:#444;line-height:1.75;text-align:justify;margin:0 0 24px;">
                Semarang Digital Kreatif (SDK) adalah coworking space dan pusat komunitas digital yang diinisiasi oleh Pemerintah Kota Semarang bersama mitra (seperti Telkom/Indigospace) untuk memfasilitasi komunitas kreatif and IT. Diresmikan pada 2016, SDK menyediakan ruang kerja gratis, fasilitas internet, dan ruang pertemuan untuk berkolaborasi serta mengembangkan konten digital di Semarang.
            </p>
            <div style="display:flex;justify-content:flex-end;">
                <button onclick="document.getElementById('sdkModal').classList.add('hidden')"
                    class="btn-red" style="font-size:14px;">
                    Tutup
                </button>
            </div>
        </div>

    </div>
</div>

@endsection