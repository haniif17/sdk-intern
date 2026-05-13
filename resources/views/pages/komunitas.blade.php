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

    /* ===== KOMUNITAS CARD ===== */
    .kom-card {
        background: #fff;
        border-radius: 20px;
        border: 1.5px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
    }
    .kom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 36px rgba(0,0,0,0.11);
        border-color: rgba(220,38,38,0.18);
    }
    .kom-card-img {
        width: 100%; height: 180px;
        object-fit: cover;
        background: #f3f3f1;
    }
    .kom-card-img-placeholder {
        width: 100%; height: 180px;
        background: #FEF2F2;
        display: flex; align-items: center; justify-content: center;
    }
    .kom-card-body { padding: 18px 18px 20px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
    .kom-card-title { font-size: 15px; font-weight: 700; color: #111; margin: 0; }
    .kom-card-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11.5px; font-weight: 700; color: #dc2626;
        background: #FEF2F2; border-radius: 20px;
        padding: 3px 10px; width: fit-content;
    }
    .kom-card-desc {
        font-size: 13px; color: #888; line-height: 1.6; margin: 4px 0 0;
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }

    /* ===== MODAL ===== */
    .bmodal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.55); z-index: 50;
        align-items: center; justify-content: center;
        padding: 16px; backdrop-filter: blur(5px);
    }
    .bmodal-overlay.open { display: flex; }

    .bmodal-card {
        background: #fff; border-radius: 24px;
        max-width: 480px; width: 100%; margin: 16px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.22);
        overflow: hidden;
        animation: modalIn 0.3s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.92) translateY(12px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .modal-img-wrap {
        width: 100%; height: 220px; overflow: hidden;
        background: #FEF2F2;
        display: flex; align-items: center; justify-content: center;
    }
    .modal-img-wrap img { width: 100%; height: 100%; object-fit: cover; }

    .info-row {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    .info-row:last-child { border-bottom: none; }
    .info-icon {
        width: 34px; height: 34px;
        background: #FEF2F2; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* ===== GRID ===== */
    .kom-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    @media (max-width: 1024px) { .kom-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 640px)  { .kom-grid { grid-template-columns: repeat(2, 1fr); } }
</style>

<div class="sdk-font page-wrapper">
<div style="max-width: 1200px; margin: 0 auto;">

    {{-- PAGE HEADER --}}
    <div style="text-align:center; margin-bottom: 44px;">
        <p class="section-eyebrow" style="justify-content:center;">SDK Booking System</p>
        <h1 style="font-size: clamp(1.9rem, 4vw, 2.8rem); font-weight: 800; color: #111; margin: 0;">Komunitas</h1>
        <p style="font-size:14.5px;color:#888;margin:10px 0 0;line-height:1.6;">Kenali komunitas-komunitas yang aktif di SDK.</p>
    </div>

    {{-- GRID CARDS --}}
    <div class="kom-grid">
        @foreach($komunitas as $item)
        <div class="kom-card" onclick="openModal({{ $item->id }})">

            {{-- Gambar --}}
            @if($item->logo)
                <img src="{{ asset($item->logo) }}" alt="{{ $item->nama_komunitas }}" class="kom-card-img">
            @else
                <div class="kom-card-img-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#fca5a5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            @endif

            <div class="kom-card-body">
                <h3 class="kom-card-title">{{ $item->nama_komunitas }}</h3>
                <span class="kom-card-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    {{ $item->jumlah_anggota }} Anggota
                </span>
                <p class="kom-card-desc">{{ $item->deskripsi ?? 'Belum ada deskripsi komunitas.' }}</p>
            </div>

        </div>
        @endforeach
    </div>

</div>
</div>

{{-- ===== MODAL DETAIL KOMUNITAS ===== --}}
<div id="komModal" class="bmodal-overlay sdk-font" onclick="closeModal(event)">
    <div class="bmodal-card" onclick="event.stopPropagation()">

        {{-- Header Gradient Merah --}}
        <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);padding:24px 24px 20px;position:relative;">
            <div style="width:36px;height:36px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h3 id="modalTitle" style="font-size:17px;font-weight:700;color:#fff;margin:0;line-height:1.3;padding-right:36px;"></h3>
            <button onclick="closeModal()"
                style="position:absolute;top:16px;right:16px;width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,0.2);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        {{-- Gambar Modal --}}
        <div class="modal-img-wrap">
            <img id="modalImage" src="" alt="" style="display:none;">
            <div id="modalNoImage" style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#fca5a5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
        </div>

        {{-- Body Info --}}
        <div style="padding:20px 24px 24px;">

            {{-- Deskripsi --}}
            <p id="modalDesc" style="font-size:13.5px;color:#666;line-height:1.7;margin:0 0 16px;padding-bottom:16px;border-bottom:1px solid rgba(0,0,0,0.06);"></p>

            <div class="info-row">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div>
                    <p style="font-size:11px;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Jumlah Anggota</p>
                    <p id="modalMember" style="font-size:14px;color:#222;font-weight:600;margin:2px 0 0;"></p>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <p style="font-size:11px;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Bergabung Sejak</p>
                    <p id="modalDate" style="font-size:14px;color:#222;font-weight:600;margin:2px 0 0;"></p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const dataKomunitas = @json($komunitas);

    function openModal(id) {
        const item = dataKomunitas.find(k => k.id === id);
        if (!item) return;

        document.getElementById('modalTitle').innerText = item.nama_komunitas;
        document.getElementById('modalDesc').innerText = item.deskripsi || 'Belum ada deskripsi komunitas.';
        document.getElementById('modalMember').innerText = (item.jumlah_anggota || '0') + ' Anggota';
        document.getElementById('modalDate').innerText = item.created_at
            ? new Date(item.created_at).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })
            : '-';

        const imgEl = document.getElementById('modalImage');
        const noImgEl = document.getElementById('modalNoImage');
        if (item.logo) {
            imgEl.src = '/' + item.logo;
            imgEl.style.display = 'block';
            noImgEl.style.display = 'none';
        } else {
            imgEl.style.display = 'none';
            noImgEl.style.display = 'flex';
        }

        const overlay = document.getElementById('komModal');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(event = null) {
        const overlay = document.getElementById('komModal');
        if (event && event.target !== overlay) return;
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }
</script>

@endsection