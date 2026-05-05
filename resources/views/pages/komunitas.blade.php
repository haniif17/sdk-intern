@extends('layouts.app')

@section('content')

<section class="px-6 py-12 bg-white">

    <div class="max-w-7xl mx-auto">

        <h2 class="text-4xl font-semibold text-center mb-10">
            Komunitas
        </h2>

        {{-- Komunitas Cards: Dibuat jadi 4 kolom dan responsif --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($komunitas as $item)
                <div onclick="openModal({{ $item->id }})"
                     class="cursor-pointer rounded-2xl overflow-hidden shadow-md hover:shadow-lg hover:scale-105 transition duration-300 flex flex-col h-full bg-[#F4F1E8]">

                    {{-- aspect-square bikin gambarnya jadi kotak sempurna sesuai referensi --}}
                    <img src="{{ asset($item->image) }}"
                         class="w-full aspect-square object-cover">

                    <div class="p-4 flex-grow flex items-center justify-center text-center">
                        <h3 class="text-lg font-semibold line-clamp-2">
                            {{ $item->nama_komunitas }}
                        </h3>
                    </div>

                </div>
            @endforeach

        </div>

    </div>

</section>

{{-- Modal (Fitur tetap dipertahankan 100%) --}}
<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-6 max-w-lg w-full relative mx-4">

        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-xl font-bold">
            ✕
        </button>

        <img id="modalImage" class="w-full h-56 object-cover rounded-lg mb-4">

        <h3 id="modalTitle" class="text-2xl font-semibold mb-2"></h3>

        <p id="modalDesc" class="text-gray-600 mb-4"></p>

        <p id="modalDate" class="text-sm text-gray-500"></p>
        <p id="modalMember" class="text-sm text-gray-500"></p>

    </div>

</div>

<script>
    const dataKomunitas = @json($komunitas);

    function openModal(id) {
        const item = dataKomunitas.find(k => k.id === id);

        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');

        document.getElementById('modalImage').src = '/' + item.image;
        document.getElementById('modalTitle').innerText = item.nama_komunitas;
        document.getElementById('modalDesc').innerText = item.deskripsi;
        document.getElementById('modalDate').innerText = 'Tanggal: ' + item.tanggal_gabung;
        document.getElementById('modalMember').innerText = 'Anggota: ' + item.jumlah_anggota;
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
    }
</script>

@endsection