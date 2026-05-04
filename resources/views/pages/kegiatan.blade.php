@extends('layouts.app')

@section('content')

<section class="px-6 py-12 bg-white">

    <div class="max-w-7xl mx-auto space-y-10">

        <h2 class="text-4xl font-semibold text-center mb-10">
            Kegiatan Terbaru
        </h2>

        @foreach($kegiatans as $kegiatan)
        <div class="bg-[#F4F1E8] rounded-2xl p-6 flex gap-8 items-start shadow-sm hover:shadow-md transition">

            {{-- IMAGE --}}
            <div class="w-[320px] h-[200px] flex-none rounded-xl overflow-hidden">
                <img src="{{ asset($kegiatan->image) }}"
                     class="w-full h-full object-cover">
            </div>

            {{-- CONTENT --}}
            <div class="flex-1 flex flex-col justify-between">

                <div>
                    {{-- DATE --}}
                    <span class="bg-red-500 text-white px-4 py-1 rounded-md text-sm">
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                    </span>

                    {{-- TITLE --}}
                    <h3 class="text-lg font-semibold mt-3">
                        {{ $kegiatan->nama_kegiatan }}
                    </h3>

                    {{-- DESCRIPTION --}}
                    <p class="text-gray-700 mt-4 leading-relaxed text-sm">
                        {{ \Illuminate\Support\Str::limit($kegiatan->deskripsi, 280) }}
                    </p>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end mt-4">
                    <button onclick="openModal({{ $kegiatan->id }})"
                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-full text-sm">
                        Detail
                    </button>
                </div>

            </div>

        </div>
        @endforeach

        {{-- PAGINATION --}}
        <div class="mt-8">
            {{ $kegiatans->links() }}
        </div>

    </div>

</section>

{{-- MODAL --}}
<div id="modal"
     onclick="closeModal(event)"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 max-w-lg w-full relative mx-4"
         onclick="event.stopPropagation()">

        <button onclick="closeModal()"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-xl font-bold">
            ✕
        </button>

        <img id="modalImage" class="w-full h-56 object-cover rounded-lg mb-4">

        <h3 id="modalTitle" class="text-2xl font-semibold mb-2"></h3>

        <p id="modalDesc" class="text-gray-600 mb-4"></p>

        <p id="modalDate" class="text-sm text-gray-500"></p>

    </div>

</div>

<script>
    // ⚠️ PENTING: karena pagination, ambil .data
    const dataKegiatan = @json($kegiatans->items());

    function openModal(id) {
        const item = dataKegiatan.find(k => k.id === id);
        if (!item) return;

        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');

        document.getElementById('modalImage').src = '/' + item.image;
        document.getElementById('modalTitle').innerText = item.nama_kegiatan;
        document.getElementById('modalDesc').innerText = item.deskripsi;
        document.getElementById('modalDate').innerText = 'Tanggal: ' + item.tanggal;

        document.body.classList.add('overflow-hidden');
    }

    function closeModal(event = null) {
        if (event && event.target !== document.getElementById('modal')) return;

        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');

        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            closeModal();
        }
    });
</script>

@endsection