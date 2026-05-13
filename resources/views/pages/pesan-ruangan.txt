@extends('layouts.app')

@section('content')

{{-- Tambahkan CDN SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-7xl mx-auto px-6 py-16">

    <h2 class="text-4xl font-semibold text-center mb-10">
        Pesan Ruangan
    </h2>

    <div class="grid md:grid-cols-2 gap-10">

        {{-- ================= FORM ================= --}}
        <div class="bg-[#F4F1E8] p-8 rounded-[13px] shadow">

            <form method="POST" action="/booking" id="bookingForm">
                @csrf

                <div class="space-y-5">

                    {{-- Nama Kegiatan --}}
                    <div>
                        <label class="font-semibold">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" required
                            class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none">
                    </div>

                    {{-- Nama Komunitas (Auto-fill & Locked if Role Komunitas) --}}
                    <div>
                        <label class="font-semibold">Nama Komunitas</label>
                        @php
                            $isKomunitas = auth()->user() && auth()->user()->role == 'komunitas' && auth()->user()->komunitas;
                            $valNama = $isKomunitas ? auth()->user()->komunitas->nama_komunitas : '';
                        @endphp
                        
                        <input type="text" name="nama_komunitas" required
                            value="{{ $valNama }}"
                            {{ $isKomunitas ? 'readonly' : '' }}
                            class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none 
                            {{ $isKomunitas ? 'bg-gray-200 cursor-not-allowed text-gray-600' : 'bg-white' }}">
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="font-semibold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" id="tanggal_booking" required
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                    </div>

                    {{-- Ruangan --}}
                    <div>
                        <label class="font-semibold">Ruangan</label>
                        <select name="ruangan" required
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                            <option value="kecil">Ruangan Kecil (5-10 orang)</option>
                            <option value="besar">Ruangan Besar (11-30 orang)</option>
                        </select>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <label class="font-semibold">Waktu</label>
                        <select name="waktu" required
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                            <option>09:00 - 12:00</option>
                            <option>13:00 - 16:00</option>
                            <option>15:00 - 18:00</option>
                        </select>
                    </div>

                    {{-- No HP --}}
                    <div>
                        <label class="font-semibold">Nomor Handphone</label>
                        <input type="text" name="no_hp" required
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="flex justify-center mt-8 gap-4">
                    <button type="submit"
                        class="bg-red-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-red-600 transition shadow-md">
                        Submit
                    </button>

                    <a href="/pesan-ruangan"
                        class="border px-6 py-3 rounded-full font-semibold bg-white hover:bg-gray-50 transition">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

        {{-- ================= KALENDER ================= --}}
        <div class="bg-[#F4F1E8] p-8 rounded-[13px] shadow">
            <h2 class="text-xl font-semibold mb-4 text-center">
                Ketersediaan Ruangan
            </h2>
            <div id="calendar"></div>
        </div>

    </div>
</div>

{{-- ================= SCRIPT & FULLCALENDAR ================= --}}
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('tanggal_booking');
    const userRole = "{{ auth()->user() ? auth()->user()->role : 'guest' }}";
    
    // --- 1. AMBIL DATA DARI DATABASE (Tabel Holidays & Bookings) ---
    const holidaysManual = @json($holidays ?? []);
    const bookingEvents = @json($bookings ?? []);

    // --- 2. LOGIKA VALIDASI TANGGAL SAAT INPUT ---
    dateInput.addEventListener('change', function() {
        const selectedStr = this.value; // YYYY-MM-DD
        const selectedDate = new Date(selectedStr);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const diffTime = selectedDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // A. Cek Apakah Hari Libur (Peringatan)
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
                if (!result.isConfirmed) {
                    this.value = '';
                }
            });
        }

        // B. Cek Aturan H-7 / H-3 (Blokir Total)
        if (userRole === 'komunitas') {
            if (diffDays < 3) {
                Swal.fire({
                    icon: 'error',
                    title: 'Waktu Terlalu Dekat',
                    text: 'Sebagai Komunitas, pemesanan ruangan minimal dilakukan H-3.',
                    confirmButtonColor: '#ef4444',
                });
                this.value = ''; 
            }
        } else {
            if (diffDays < 7) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Akses Terbatas',
                    text: 'Untuk tamu umum, pemesanan minimal H-7. Silakan daftar sebagai komunitas untuk mendapatkan akses booking H-3!',
                    confirmButtonColor: '#ef4444',
                });
                this.value = ''; 
            }
        }
    });

    // --- 3. KONFIGURASI KALENDER ---
    let calendarEl = document.getElementById('calendar');
    let events = [];

    // Masukkan Data Bookingan Orang Lain (Merah Solid)
    bookingEvents.forEach(b => {
        events.push({
            title: b.nama_komunitas,
            start: b.tanggal,
            color: '#ef4444',
            extendedProps: { type: 'booking', ...b }
        });
    });

    // Masukkan Data Hari Libur Manual (Merah Muda / Pink)
    holidaysManual.forEach(h => {
        events.push({
            title: "🔴 " + h.keterangan,
            start: h.tanggal,
            color: '#fee2e2',
            textColor: '#991b1b',
            allDay: true,
            extendedProps: { type: 'holiday', keterangan: h.keterangan }
        });
    });

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,
        eventClick: function(info) {
            let e = info.event;
            
            // Jika Klik Hari Libur
            if(e.extendedProps.type === 'holiday') {
                Swal.fire({
                    title: 'Hari Libur Nasional',
                    text: e.extendedProps.keterangan,
                    icon: 'info',
                    confirmButtonColor: '#ef4444'
                });
                return;
            }

            // Jika Klik Bookingan
            document.getElementById('modalTitle').innerText = e.title;
            document.getElementById('modalKomunitas').innerText = "Komunitas: " + e.extendedProps.nama_komunitas;
            document.getElementById('modalRuangan').innerText = "Ruangan: " + e.extendedProps.ruangan;
            document.getElementById('modalWaktu').innerText = "Waktu: " + e.extendedProps.waktu;
            document.getElementById('modalTanggal').innerText = "Tanggal: " + e.startStr;

            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('bookingModal').classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }
    });

    calendar.render();
});

function closeBookingModal(event = null) {
    if (event && event.target !== document.getElementById('bookingModal')) return;
    document.getElementById('bookingModal').classList.add('hidden');
    document.getElementById('bookingModal').classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
}
</script>

{{-- SCRIPT SESSION --}}
@if(session('success'))
    <script>Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", confirmButtonColor: '#ef4444' });</script>
@endif
@if(session('error'))
    <script>Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}", confirmButtonColor: '#ef4444' });</script>
@endif

{{-- MODAL DETAIL BOOKING --}}
<div id="bookingModal" onclick="closeBookingModal(event)" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full relative mx-4" onclick="event.stopPropagation()">
        <button onclick="closeBookingModal()" class="absolute top-4 right-4 text-xl font-bold">✕</button>
        <h3 id="modalTitle" class="text-xl font-semibold mb-4 text-center"></h3>
        <div class="space-y-2 text-gray-700">
            <p id="modalKomunitas"></p>
            <p id="modalRuangan"></p>
            <p id="modalWaktu"></p>
            <p id="modalTanggal"></p>
        </div>
    </div>
</div>

@endsection