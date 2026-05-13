@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap');

    .sdk-font { font-family: 'Plus Jakarta Sans', sans-serif; }

    .page-wrapper {
        background: #fafaf8;
        min-height: 100vh;
        padding: 60px 24px 80px;
    }

    .section-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        color: #dc2626; font-size: 12px; font-weight: 700;
        letter-spacing: 1.4px; text-transform: uppercase;
        margin-bottom: 8px;
    }
    .section-eyebrow::before {
        content: ''; display: block;
        width: 20px; height: 2px; background: #dc2626; border-radius: 2px;
    }

    .map-card {
        background: #fff;
        border-radius: 24px;
        border: 1.5px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        overflow: hidden;
        margin-bottom: 32px;
    }

    .map-header {
        display: flex; align-items: center; gap: 12px;
        padding: 22px 28px;
        border-bottom: 1px solid rgba(0,0,0,0.07);
    }

    .info-card {
        background: #fff;
        border-radius: 24px;
        padding: 32px 28px;
        border: 1.5px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        text-align: center;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(0,0,0,0.11);
        border-color: rgba(220,38,38,0.18);
    }

    .info-icon-wrap {
        width: 52px; height: 52px;
        background: #FEF2F2;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 16px;
        flex-shrink: 0;
    }

    .info-card-title {
        font-size: 15px; font-weight: 700; color: #111;
        margin: 0 0 8px;
    }
    .info-card-text {
        font-size: 13.5px; color: #888; line-height: 1.7; margin: 0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    @media (max-width: 768px) {
        .info-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="sdk-font page-wrapper">
<div style="max-width: 1100px; margin: 0 auto;">

    {{-- PAGE HEADER --}}
    <div style="text-align:center; margin-bottom: 44px;">
        <p class="section-eyebrow" style="justify-content:center;">SDK Booking System</p>
        <h1 style="font-size: clamp(1.9rem, 4vw, 2.8rem); font-weight: 800; color: #111; margin: 0;">Hubungi Kami</h1>
        <p style="font-size:14.5px;color:#888;margin:10px 0 0;line-height:1.6;">Temukan kami di sini, atau hubungi langsung tim SDK.</p>
    </div>

    {{-- MAP CARD --}}
    <div class="map-card">
        <div class="map-header">
            <div style="width:42px;height:42px;background:#FEF2F2;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <h2 style="font-size:16px;font-weight:700;color:#111;margin:0;">Lokasi Kami</h2>
                <p style="font-size:12.5px;color:#999;margin:0;">Semarang Digital Kreatif — Jl. Tri Lomba Juang</p>
            </div>
        </div>
        <iframe
            src="https://maps.google.com/maps?q=Semarang%20Digital%20Kreatif%20Tri%20Lomba%20Juang&t=&z=16&ie=UTF8&iwloc=&output=embed"
            style="width:100%;height:420px;border:0;display:block;"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    {{-- INFO CARDS --}}
    <div class="info-grid">

        {{-- Alamat --}}
        <div class="info-card">
            <div class="info-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="info-card-title">Alamat</h3>
            <p class="info-card-text">Jl. Tri Lomba Juang, Mugassari, Kec. Semarang Sel.,<br>Kota Semarang, Jawa Tengah 50249</p>
        </div>

        {{-- Telepon --}}
        <div class="info-card">
            <div class="info-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.39 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.97-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <h3 class="info-card-title">Telepon</h3>
            <p class="info-card-text" style="margin-bottom:8px;">Dev by @syhdaana</p>
            <a href="tel:+628774447348"
               style="display:inline-flex;align-items:center;gap:6px;color:#dc2626;font-weight:700;font-size:15px;text-decoration:none;font-family:'Plus Jakarta Sans',sans-serif;">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                +62 123-456-789
            </a>
        </div>

        {{-- Jam Kerja --}}
        <div class="info-card">
            <div class="info-icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <h3 class="info-card-title">Jam Kerja</h3>
            <p class="info-card-text">Setiap Hari</p>
            <p style="font-size:20px;font-weight:800;color:#111;margin:6px 0 0;font-family:'Plus Jakarta Sans',sans-serif;">08:00 – 22:00</p>
        </div>

    </div>

</div>
</div>

@endsection