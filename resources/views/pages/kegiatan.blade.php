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

    /* Kegiatan Card */
    .kegiatan-card {
        background: #fff;
        border-radius: 22px;
        border: 1.5px solid rgba(0,0,0,0.07);
        box-shadow: 0 2px 16px rgba(0,0,0,0.05);
        overflow: hidden;
        display: flex;
        gap: 0;
        transition: all 0.3s cubic-bezier(.4,0,.2,1);
    }
    .kegiatan-card:hover {
        border-color: rgba(220,38,38,0.18);
        box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }

    .card-image-wrap {
        width: 300px;
        min-height: 220px;
        flex-shrink: 0;
        overflow: hidden;
        position: relative;
    }
    .card-image-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform 0.55s cubic-bezier(.4,0,.2,1);
    }
    .kegiatan-card:hover .card-image-wrap img { transform: scale(1.06); }

    .card-body {
        flex: 1;
        padding: 28px 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-left: 1px solid rgba(0,0,0,0.06);
    }

    .date-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: #FEF2F2;
        color: #dc2626;
        border: 1.5px solid rgba(220,38,38,0.2);
        padding: 5px 13px;
        border-radius: 50px;
        font-size: 12px; font-weight: 700;
        letter-spacing: 0.2px;
    }

    .btn-red {
        display: inline-flex; align-items: center; gap: 7px;
        background: #dc2626; color: #fff;
        padding: 10px 22px; border-radius: 50px;
        font-weight: 700; font-size: 13px;
        border: none; cursor: pointer;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(220,38,38,0.28);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-red:hover {
        background: #b91c1c;
        box-shadow: 0 6px 20px rgba(220,38,38,0.38);
        transform: translateY(-1px);
        color: #fff;
    }

    /* Card number badge */
    .card-number {
        position: absolute; top: 14px; left: 14px;
        width: 30px; height: 30px;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(6px);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 12px; font-weight: 700;
        z-index: 2;
    }

    /* Pagination override */
    .pagination { display: flex; gap: 6px; justify-content: center; flex-wrap: wrap; }
    .pagination span, .pagination a {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 36px; height: 36px; padding: 0 10px;
        border-radius: 10px;
        font-size: 13px; font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        border: 1.5px solid rgba(0,0,0,0.1);
        color: #444; text-decoration: none;
        transition: all 0.2s ease;
    }
    .pagination a:hover { border-color: #dc2626; color: #dc2626; background: #FEF2F2; }
    .pagination .active span, .pagination span[aria-current="page"] {
        background: #dc2626; border-color: #dc2626; color: #fff;
    }
    .pagination [disabled], .pagination span.disabled {
        opacity: 0.4; pointer-events: none;
    }

    /* Modal */
    .modal-card {
        background: #fff; border-radius: 24px;
        max-width: 500px; width: 100%; margin: 16px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.22);
        overflow: hidden;
        animation: modalIn 0.3s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.92) translateY(12px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    @media (max-width: 640px) {
        .kegiatan-card { flex-direction: column; }
        .card-image-wrap { width: 100%; min-height: 200px; }
        .card-body { border-left: none; border-top: 1px solid rgba(0,0,0,0.06); padding: 20px; }
    }
</style>

<div class="sdk-font page-wrapper">
<div style="max-width: 900px; margin: 0 auto;">

    {{-- HEADER --}}
    <div style="text-align:center; margin-bottom: 44px;">
        <p class="section-eyebrow" style="justify-content:center;">Semarang Digital Kreatif</p>
        <h1 style="font-size: clamp(1.9rem, 4vw, 2.8rem); font-weight: 800; color: #111; margin: 0;">Kegiatan Terbaru</h1>
        <p style="font-size:14.5px;color:#999;margin:10px 0 0;">Dokumentasi berbagai kegiatan dan event yang telah berlangsung di SDK.</p>
    </div>

    {{-- CARD LIST --}}
    <div style="display: flex; flex-direction: column; gap: 20px;">

        @foreach($kegiatans as $index => $kegiatan)
        <div class="kegiatan-card">

            {{-- IMAGE --}}
            <div class="card-image-wrap">
                <div class="card-number">{{ $loop->iteration }}</div>
                <img src="{{ asset($kegiatan->image) }}" alt="{{ $kegiatan->nama_kegiatan }}">
            </div>

            {{-- CONTENT --}}
            <div class="card-body">

                <div>
                    {{-- DATE --}}
                    <span class="date-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                    </span>

                    {{-- TITLE --}}
                    <h3 style="font-size:17px;font-weight:700;color:#111;margin:14px 0 10px;line-height:1.35;">
                        {{ $kegiatan->nama_kegiatan }}
                    </h3>

                    {{-- DIVIDER --}}
                    <div style="height:1px;background:rgba(0,0,0,0.06);margin-bottom:12px;"></div>

                    {{-- DESCRIPTION --}}
                    <p style="font-size:13.5px;color:#666;line-height:1.7;margin:0;">
                        {{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 280) }}
                    </p>
                </div>

                {{-- BUTTON --}}
                <div style="display:flex;justify-content:flex-end;margin-top:20px;padding-top:16px;border-top:1px solid rgba(0,0,0,0.06);">
                    <button onclick="openModal({{ $kegiatan->id }})" class="btn-red">
                        Lihat Detail
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </div>

            </div>

        </div>
        @endforeach

    </div>

    {{-- PAGINATION --}}
    <div style="margin-top: 40px;">
        {{ $kegiatans->links() }}
    </div>

</div>
</div>

{{-- MODAL --}}
<div id="modal"
     onclick="closeModal(event)"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:50;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(5px);">

    <div class="modal-card sdk-font" onclick="event.stopPropagation()">

        {{-- Image area --}}
        <div style="position:relative;">
            <img id="modalImage" style="width:100%;height:230px;object-fit:cover;display:block;" alt="">
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.5) 0%,transparent 55%);"></div>

            {{-- Close btn --}}
            <button onclick="closeModal()"
                style="position:absolute;top:12px;right:12px;width:34px;height:34px;border-radius:50%;background:rgba(0,0,0,0.45);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px);">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>

            {{-- Date on image --}}
            <div style="position:absolute;bottom:14px;left:16px;">
                <span id="modalDate" style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.85);color:#fff;padding:4px 12px;border-radius:50px;font-size:12px;font-weight:700;backdrop-filter:blur(4px);font-family:'Plus Jakarta Sans',sans-serif;"></span>
            </div>
        </div>

        {{-- Body --}}
        <div style="padding:24px 26px 28px;">
            <h3 id="modalTitle" style="font-size:19px;font-weight:700;color:#111;margin:0 0 14px;line-height:1.35;font-family:'Plus Jakarta Sans',sans-serif;"></h3>
            <div style="height:1px;background:rgba(0,0,0,0.07);margin-bottom:14px;"></div>
            <p id="modalDesc" style="font-size:13.5px;color:#555;line-height:1.75;margin:0;font-family:'Plus Jakarta Sans',sans-serif;"></p>
        </div>

    </div>

</div>

<script>
    const dataKegiatan = @json($kegiatans->items());

    function openModal(id) {
        const item = dataKegiatan.find(k => k.id === id);
        if (!item) return;

        document.getElementById('modal').style.display = 'flex';
        document.getElementById('modalImage').src = '/' + item.image;
        document.getElementById('modalTitle').innerText = item.nama_kegiatan;
        document.getElementById('modalDesc').innerText = item.deskripsi;
        document.getElementById('modalDate').innerText = 'Tanggal: ' + item.tanggal;
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