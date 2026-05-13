@extends('layouts.app')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .sdk-font { font-family: 'Plus Jakarta Sans', sans-serif; }

    .page-wrapper {
        background: #fafaf8;
        min-height: 100vh;
        padding: 56px 24px 80px;
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

    .fasilitas-card {
        background: #fff;
        border-radius: 20px;
        border: 1.5px solid rgba(0,0,0,0.08);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.32s cubic-bezier(.4,0,.2,1);
        box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        position: relative;
    }
    .fasilitas-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #dc2626, #ef4444);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    .fasilitas-card:hover::after { transform: scaleX(1); }
    .fasilitas-card:hover {
        border-color: rgba(220,38,38,0.2);
        box-shadow: 0 16px 44px rgba(0,0,0,0.11);
        transform: translateY(-5px);
    }

    .fasilitas-img-wrap {
        overflow: hidden;
        height: 165px;
        position: relative;
    }
    .fasilitas-img-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.5s cubic-bezier(.4,0,.2,1);
    }
    .fasilitas-card:hover .fasilitas-img-wrap img { transform: scale(1.07); }

    .zoom-hint {
        position: absolute; inset: 0;
        background: rgba(220,38,38,0);
        display: flex; align-items: center; justify-content: center;
        transition: background 0.3s ease;
    }
    .zoom-hint-icon {
        width: 40px; height: 40px;
        background: rgba(255,255,255,0.92);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transform: scale(0.7);
        transition: all 0.3s cubic-bezier(.34,1.56,.64,1);
    }
    .fasilitas-card:hover .zoom-hint { background: rgba(0,0,0,0.1); }
    .fasilitas-card:hover .zoom-hint-icon { opacity: 1; transform: scale(1); }

    .fasilitas-body { padding: 18px 18px 20px; }

    /* Modal */
    .modal-card {
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
</style>

<div class="sdk-font page-wrapper">
<div style="max-width: 1200px; margin: 0 auto;">

    {{-- HEADER --}}
    <div style="text-align:center; margin-bottom: 44px;">
        <p class="section-eyebrow" style="justify-content:center;">Apa yang Kami Sediakan</p>
        <h1 style="font-size: clamp(1.9rem, 4vw, 2.8rem); font-weight: 800; color: #111; margin: 0;">Fasilitas Kami</h1>
        <p style="font-size:14.5px;color:#999;margin:10px 0 0;">Klik kartu untuk melihat detail fasilitas yang tersedia di SDK.</p>
    </div>

    {{-- GRID --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">

        @foreach($fasilitas as $item)
            <div class="fasilitas-card" onclick="openModal(
                    '{{ asset($item->image) }}',
                    '{{ addslashes($item->title) }}',
                    `{{ addslashes($item->description) }}`
                )">

                <div class="fasilitas-img-wrap">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                    <div class="zoom-hint">
                        <div class="zoom-hint-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                        </div>
                    </div>
                </div>

                <div class="fasilitas-body">
                    <h3 style="font-size:15px;font-weight:700;color:#111;text-align:center;margin:0 0 8px;line-height:1.3;">
                        {{ $item->title }}
                    </h3>
                    <p style="font-size:12.5px;color:#888;text-align:center;margin:0;line-height:1.6;">
                        {{ \Illuminate\Support\Str::limit($item->description, 80) }}
                    </p>
                </div>

            </div>
        @endforeach

    </div>

</div>
</div>

{{-- MODAL --}}
<div id="modal"
     onclick="closeModal(event)"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:50;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(5px);">

    <div class="modal-card sdk-font" onclick="event.stopPropagation()">

        <div style="position:relative;">
            <img id="modalImage" style="width:100%;height:230px;object-fit:cover;display:block;" alt="">
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.35) 0%,transparent 55%);"></div>
            <button onclick="closeModal()"
                style="position:absolute;top:12px;right:12px;width:34px;height:34px;border-radius:50%;background:rgba(0,0,0,0.45);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div style="padding:24px 26px 28px;text-align:center;">
            <div style="width:38px;height:38px;background:#FEF2F2;border-radius:11px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <h3 id="modalTitle" style="font-size:19px;font-weight:700;color:#111;margin:0 0 12px;"></h3>
            <div style="height:1px;background:rgba(0,0,0,0.07);margin-bottom:14px;"></div>
            <p id="modalDesc" style="font-size:13.5px;color:#666;line-height:1.75;margin:0;"></p>
        </div>

    </div>

</div>

<script>
    function openModal(image, title, desc) {
        document.getElementById('modal').style.display = 'flex';
        document.getElementById('modalImage').src = image;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDesc').innerText = desc;
        document.body.style.overflow = 'hidden';
    }

    function closeModal(event = null) {
        if (event && event.target !== document.getElementById('modal')) return;
        document.getElementById('modal').style.display = 'none';
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
</script>

@endsection