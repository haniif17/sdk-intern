@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-16">

    <h1 class="text-3xl font-semibold text-center mb-10">
        Pesan Ruangan
    </h1>

    <div class="grid md:grid-cols-2 gap-10">

        {{-- ================= FORM ================= --}}
        <div class="bg-[#F4F1E8] p-8 rounded-[13px] shadow">

            <form method="POST" action="/booking">
                @csrf

                <div class="space-y-5">

                    {{-- Nama Kegiatan --}}
                    <div>
                        <label class="font-semibold">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan"
                            class="w-full mt-1 px-4 py-2 rounded-lg border focus:outline-none">
                    </div>

                    {{-- Nama Komunitas --}}
                    <div>
                        <label class="font-semibold">Nama Komunitas</label>
                        <input type="text" name="nama_komunitas"
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label class="font-semibold">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal"
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                    </div>

                    {{-- Ruangan --}}
                    <div>
                        <label class="font-semibold">Ruangan</label>
                        <select name="ruangan"
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                            <option value="kecil">Ruangan Kecil (5-10 orang)</option>
                            <option value="besar">Ruangan Besar (11-30 orang)</option>
                        </select>
                    </div>

                    {{-- Waktu --}}
                    <div>
                        <label class="font-semibold">Waktu</label>
                        <select name="waktu"
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                            <option>09:00 - 12:00</option>
                            <option>13:00 - 16:00</option>
                            <option>15:00 - 18:00</option>
                        </select>
                    </div>

                    {{-- No HP --}}
                    <div>
                        <label class="font-semibold">Nomor Handphone</label>
                        <input type="text" name="no_hp"
                            class="w-full mt-1 px-4 py-2 rounded-lg border">
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="flex justify-center mt-8 gap-4">

                    <button type="submit"
                        class="bg-red-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-red-600 transition">
                        Submit
                    </button>

                    <a href="/pesan-ruangan"
                        class="border px-6 py-3 rounded-full font-semibold">
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


{{-- ================= FULLCALENDAR ================= --}}
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');

    let bookings = @json($bookings ?? []);

    let events = bookings.map(function(b) {
        return {
            title: b.nama_komunitas,
            start: b.tanggal,
            color: 'red',

            extendedProps: {
                komunitas: b.nama_komunitas,
                ruangan: b.ruangan,
                waktu: b.waktu,
                tanggal: b.tanggal
            }
        };
    });

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: events,

        eventClick: function(info) {
            let e = info.event;

            // isi modal
            document.getElementById('modalTitle').innerText = e.title;
            document.getElementById('modalKomunitas').innerText = "Komunitas: " + e.extendedProps.komunitas;
            document.getElementById('modalRuangan').innerText = "Ruangan: " + e.extendedProps.ruangan;
            document.getElementById('modalWaktu').innerText = "Waktu: " + e.extendedProps.waktu;
            document.getElementById('modalTanggal').innerText = "Tanggal: " + e.startStr;

            // buka modal
            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('bookingModal').classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }
    });

    calendar.render();
});

// close modal
function closeBookingModal(event = null) {
    if (event && event.target !== document.getElementById('bookingModal')) return;

    document.getElementById('bookingModal').classList.add('hidden');
    document.getElementById('bookingModal').classList.remove('flex');

    document.body.classList.remove('overflow-hidden');
}
</script>

{{-- MODAL DETAIL BOOKING --}}
<div id="bookingModal"
    onclick="closeBookingModal(event)"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 max-w-md w-full relative mx-4"
        onclick="event.stopPropagation()">

        <button onclick="closeBookingModal()"
            class="absolute top-4 right-4 text-xl font-bold">
            ✕
        </button>

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