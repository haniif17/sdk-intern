@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />

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

    .form-card {
        background: #fff;
        border-radius: 24px;
        padding: 36px;
        border: 1.5px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }
    .calendar-card {
        background: #fff;
        border-radius: 24px;
        padding: 28px;
        border: 1.5px solid rgba(0,0,0,0.07);
        box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #333;
        letter-spacing: 0.3px;
        margin-bottom: 6px;
    }

    .form-input, .form-select {
        width: 100%;
        padding: 11px 16px;
        border-radius: 12px;
        border: 1.5px solid rgba(0,0,0,0.12);
        background: #fafaf8;
        font-size: 14px;
        color: #222;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        box-sizing: border-box;
        appearance: none;
        -webkit-appearance: none;
    }
    .form-input:focus, .form-select:focus {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
        background: #fff;
    }
    .form-input.locked {
        background: #f3f3f1;
        color: #888;
        cursor: not-allowed;
        border-color: rgba(0,0,0,0.08);
    }

    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '';
        position: absolute; right: 14px; top: 50%;
        transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 6px solid #888;
        pointer-events: none;
    }

    .input-group { position: relative; }
    .input-icon {
        position: absolute; left: 13px; top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }
    .input-group .form-input { padding-left: 40px; }

    .form-divider { height: 1px; background: rgba(0,0,0,0.06); margin: 4px 0; }

    .btn-red {
        display: inline-flex; align-items: center; gap: 8px;
        background: #dc2626; color: #fff;
        padding: 12px 28px; border-radius: 50px;
        font-weight: 700; font-size: 14px;
        border: none; cursor: pointer;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 16px rgba(220,38,38,0.3);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-red:hover { background: #b91c1c; box-shadow: 0 6px 20px rgba(220,38,38,0.38); transform: translateY(-1px); color: #fff; }

    .btn-outline {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; border: 1.5px solid rgba(0,0,0,0.14);
        color: #444; padding: 12px 28px; border-radius: 50px;
        font-weight: 600; font-size: 14px; text-decoration: none;
        transition: all 0.25s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-outline:hover { background: #f5f5f3; border-color: rgba(0,0,0,0.22); color: #222; }

    /* FullCalendar overrides */
    .fc .fc-toolbar-title { font-size: 15px !important; font-weight: 700 !important; color: #111 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
    .fc .fc-button { background: #dc2626 !important; border-color: #dc2626 !important; border-radius: 8px !important; font-family: 'Plus Jakarta Sans', sans-serif !important; font-size: 12px !important; padding: 5px 11px !important; }
    .fc .fc-button:hover { background: #b91c1c !important; border-color: #b91c1c !important; }
    .fc .fc-day-today { background: #FEF2F2 !important; }
    .fc .fc-col-header-cell { font-weight: 700 !important; font-size: 11px !important; text-transform: uppercase !important; letter-spacing: 0.5px !important; color: #888 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; }
    .fc .fc-daygrid-day-number { font-size: 12px !important; font-weight: 600 !important; font-family: 'Plus Jakarta Sans', sans-serif !important; color: #333 !important; }
    .fc .fc-event { border-radius: 6px !important; font-size: 10.5px !important; font-weight: 600 !important; border: none !important; }
    .fc-theme-standard .fc-scrollgrid { border-color: rgba(0,0,0,0.07) !important; }

    /* Legend */
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }

    /* Modal */
    .bmodal-card {
        background: #fff; border-radius: 24px;
        max-width: 400px; width: 100%; margin: 16px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.22);
        overflow: hidden;
        animation: modalIn 0.3s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.92) translateY(12px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
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

    @media (max-width: 768px) {
        .two-col-grid { grid-template-columns: 1fr !important; }
    }
</style>

<div class="sdk-font page-wrapper">
<div style="max-width: 1200px; margin: 0 auto;">

    {{-- PAGE HEADER --}}
    <div style="text-align:center; margin-bottom: 44px;">
        <p class="section-eyebrow" style="justify-content:center;">SDK Booking System</p>
        <h1 style="font-size: clamp(1.9rem, 4vw, 2.8rem); font-weight: 800; color: #111; margin: 0;">Pesan Ruangan</h1>
        <p style="font-size:14.5px;color:#888;margin:10px 0 0;line-height:1.6;">Isi formulir di bawah dan cek ketersediaan ruangan pada kalender.</p>
    </div>

    <div class="two-col-grid" style="display:grid; grid-template-columns: 1fr 1fr; gap: 28px; align-items: start;">

        {{-- ===== FORM ===== --}}
        <div class="form-card">

            <div style="display:flex;align-items:center;gap:12px;margin-bottom:28px;padding-bottom:20px;border-bottom:1px solid rgba(0,0,0,0.07);">
                <div style="width:42px;height:42px;background:#FEF2F2;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <h2 style="font-size:16px;font-weight:700;color:#111;margin:0;">Detail Pemesanan</h2>
                    <p style="font-size:12.5px;color:#999;margin:0;">Lengkapi semua informasi di bawah ini</p>
                </div>
            </div>

            <form method="POST" action="/booking" id="bookingForm">
                @csrf

                <div style="display:flex;flex-direction:column;gap:18px;">

                    {{-- Nama Kegiatan --}}
                    <div>
                        <label class="form-label">Nama Kegiatan</label>
                        <div class="input-group">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            <input type="text" name="nama_kegiatan" required placeholder="Cth: Workshop UI/UX Design" class="form-input">
                        </div>
                    </div>

                    {{-- Nama Komunitas --}}
                    <div>
                        <label class="form-label">Nama Komunitas</label>
                        @php
                            $isKomunitas = auth()->user() && auth()->user()->role == 'komunitas' && auth()->user()->komunitas;
                            $valNama = $isKomunitas ? auth()->user()->komunitas->nama_komunitas : '';
                        @endphp
                        <div class="input-group">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <input type="text" name="nama_komunitas" required
                                value="{{ $valNama }}"
                                {{ $isKomunitas ? 'readonly' : '' }}
                                placeholder="Nama komunitas Anda"
                                class="form-input {{ $isKomunitas ? 'locked' : '' }}">
                        </div>
                        @if($isKomunitas)
                            <p style="font-size:11.5px;color:#dc2626;margin:5px 0 0;display:flex;align-items:center;gap:4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                Otomatis diisi dari akun komunitas Anda
                            </p>
                        @endif
                    </div>

                    <div class="form-divider"></div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="form-label">Tanggal Kegiatan</label>
                        <div class="input-group">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            <input type="date" name="tanggal" id="tanggal_booking" required class="form-input">
                        </div>
                    </div>

                    {{-- Ruangan --}}
                    <div>
                        <label class="form-label">Ruangan</label>
                        <div class="select-wrap">
                            <select name="ruangan" required class="form-select">
                                <option value="kecil">Ruangan Kecil (5–10 orang)</option>
                                <option value="besar">Ruangan Besar (11–30 orang)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <label class="form-label">Sesi Waktu</label>
                        <div class="select-wrap">
                            <select name="waktu" required class="form-select">
                                <option>09:00 - 12:00</option>
                                <option>13:00 - 16:00</option>
                                <option>15:00 - 18:00</option>
                            </select>
                        </div>
                    </div>

                    {{-- No HP --}}
                    <div>
                        <label class="form-label">Nomor Handphone</label>
                        <div class="input-group">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.39 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.97-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <input type="text" name="no_hp" required placeholder="Cth: 08123456789" class="form-input">
                        </div>
                    </div>

                </div>

                <div style="display:flex;justify-content:center;gap:12px;margin-top:32px;padding-top:24px;border-top:1px solid rgba(0,0,0,0.07);">
                    <button type="submit" class="btn-red">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Submit Pemesanan
                    </button>
                    <a href="/pesan-ruangan" class="btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        Batal
                    </a>
                </div>

            </form>
        </div>

        {{-- ===== CALENDAR ===== --}}
        <div class="calendar-card">

            <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;padding-bottom:18px;border-bottom:1px solid rgba(0,0,0,0.07);">
                <div style="width:42px;height:42px;background:#FEF2F2;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <h2 style="font-size:16px;font-weight:700;color:#111;margin:0;">Ketersediaan Ruangan</h2>
                    <p style="font-size:12.5px;color:#999;margin:0;">Klik event untuk melihat detail</p>
                </div>
            </div>

            {{-- Legend --}}
            <div style="display:flex;gap:16px;margin-bottom:16px;flex-wrap:wrap;">
                <div style="display:flex;align-items:center;gap:6px;">
                    <div class="legend-dot" style="background:#ef4444;"></div>
                    <span style="font-size:12px;color:#666;font-weight:600;">Sudah Dibooking</span>
                </div>
                <div style="display:flex;align-items:center;gap:6px;">
                    <div class="legend-dot" style="background:#fca5a5;"></div>
                    <span style="font-size:12px;color:#666;font-weight:600;">Hari Libur</span>
                </div>
                <div style="display:flex;align-items:center;gap:6px;">
                    <div class="legend-dot" style="background:#FEF2F2;border:1.5px solid #fca5a5;"></div>
                    <span style="font-size:12px;color:#666;font-weight:600;">Hari Ini</span>
                </div>
            </div>

            <div id="calendar"></div>
        </div>

    </div>
</div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('tanggal_booking');
    const userRole = "{{ auth()->user() ? auth()->user()->role : 'guest' }}";

    const holidaysManual = @json($holidays ?? []);
    const bookingEvents = @json($bookings ?? []);

    dateInput.addEventListener('change', function() {
        const selectedStr = this.value;
        const selectedDate = new Date(selectedStr);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const diffTime = selectedDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        const isHoliday = holidaysManual.find(h => h.tanggal === selectedStr);
        if (isHoliday) {
            Swal.fire({
                icon: 'warning',
                title: 'Info Hari Libur',
                text: `Tanggal tersebut adalah ${isHoliday.keterangan}. Tetap ingin melanjutkan pemesanan?`,
                confirmButtonColor: '#ef4444',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Pilih Tanggal Lain'
            }).then((result) => {
                if (!result.isConfirmed) this.value = '';
            });
        }

        if (userRole === 'komunitas') {
            if (diffDays < 3) {
                Swal.fire({ icon: 'error', title: 'Waktu Terlalu Dekat', text: 'Sebagai Komunitas, pemesanan ruangan minimal dilakukan H-3.', confirmButtonColor: '#ef4444' });
                this.value = '';
            }
        } else {
            if (diffDays < 7) {
                Swal.fire({ icon: 'warning', title: 'Akses Terbatas', text: 'Untuk tamu umum, pemesanan minimal H-7. Silakan daftar sebagai komunitas untuk mendapatkan akses booking H-3!', confirmButtonColor: '#ef4444' });
                this.value = '';
            }
        }
    });

    let calendarEl = document.getElementById('calendar');
    let events = [];

    bookingEvents.forEach(b => {
        events.push({ title: b.nama_komunitas, start: b.tanggal, color: '#ef4444', extendedProps: { type: 'booking', ...b } });
    });

    holidaysManual.forEach(h => {
        events.push({ title: "🔴 " + h.keterangan, start: h.tanggal, color: '#fee2e2', textColor: '#991b1b', allDay: true, extendedProps: { type: 'holiday', keterangan: h.keterangan } });
    });

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,
        eventClick: function(info) {
            let e = info.event;
            if (e.extendedProps.type === 'holiday') {
                Swal.fire({ title: 'Hari Libur Nasional', text: e.extendedProps.keterangan, icon: 'info', confirmButtonColor: '#ef4444' });
                return;
            }
            document.getElementById('modalTitle').innerText = e.title;
            document.getElementById('modalKomunitas').innerText = e.extendedProps.nama_komunitas;
            document.getElementById('modalRuangan').innerText = e.extendedProps.ruangan;
            document.getElementById('modalWaktu').innerText = e.extendedProps.waktu;
            document.getElementById('modalTanggal').innerText = e.startStr;
            document.getElementById('bookingModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    });

    calendar.render();
});

function closeBookingModal(event = null) {
    if (event && event.target !== document.getElementById('bookingModal')) return;
    document.getElementById('bookingModal').style.display = 'none';
    document.body.style.overflow = '';
}
</script>

@if(session('success'))
    <script>Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", confirmButtonColor: '#ef4444' });</script>
@endif
@if(session('error'))
    <script>Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}", confirmButtonColor: '#ef4444' });</script>
@endif

{{-- MODAL DETAIL BOOKING --}}
<div id="bookingModal" onclick="closeBookingModal(event)"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:50;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(5px);">

    <div class="bmodal-card sdk-font" onclick="event.stopPropagation()">

        <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);padding:24px 24px 20px;position:relative;">
            <div style="width:36px;height:36px;background:rgba(255,255,255,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <h3 id="modalTitle" style="font-size:17px;font-weight:700;color:#fff;margin:0;line-height:1.3;padding-right:36px;"></h3>
            <button onclick="closeBookingModal()"
                style="position:absolute;top:16px;right:16px;width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,0.2);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <div style="padding:20px 24px 24px;">

            <div class="info-row">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                </div>
                <div>
                    <p style="font-size:11px;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Komunitas</p>
                    <p id="modalKomunitas" style="font-size:14px;color:#222;font-weight:600;margin:2px 0 0;"></p>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <div>
                    <p style="font-size:11px;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Ruangan</p>
                    <p id="modalRuangan" style="font-size:14px;color:#222;font-weight:600;margin:2px 0 0;text-transform:capitalize;"></p>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <p style="font-size:11px;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Waktu</p>
                    <p id="modalWaktu" style="font-size:14px;color:#222;font-weight:600;margin:2px 0 0;"></p>
                </div>
            </div>

            <div class="info-row">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <div>
                    <p style="font-size:11px;color:#aaa;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin:0;">Tanggal</p>
                    <p id="modalTanggal" style="font-size:14px;color:#222;font-weight:600;margin:2px 0 0;"></p>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection