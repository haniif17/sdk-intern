@extends('layouts.app')

@section('content')

<section class="px-6 py-12 bg-white min-h-screen">

    {{-- max-w-6xl bikin gridnya nggak terlalu melebar berlebihan --}}
    <div class="max-w-6xl mx-auto">

        <h2 class="text-3xl md:text-4xl font-semibold text-center mb-10 text-gray-800">
            Komunitas
        </h2>

        {{-- Komunitas Cards: 4 kolom untuk Desktop, 3 untuk Tablet, 2 untuk HP --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">

            @foreach($komunitas as $item)
                {{-- PERBAIKAN 1: Tambahkan onclick, cursor-pointer, dan efek hover di sini --}}
                <div onclick="openModal({{ $item->id }})" class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 flex flex-col cursor-pointer hover:shadow-xl transition-all hover:-translate-y-1">
                    
                    {{-- Bagian Gambar/Logo --}}
                    <div class="h-48 w-full overflow-hidden bg-gray-100">
                        @if($item->logo)
                            <img src="{{ asset($item->logo) }}" alt="{{ $item->nama_komunitas }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <span>No Logo</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-800">{{ $item->nama_komunitas }}</h3>
                        <p class="text-sm text-red-500 font-semibold mb-3">{{ $item->jumlah_anggota }} Anggota</p>
                        
                        {{-- Bagian Deskripsi --}}
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                            {!! nl2br(e($item->deskripsi ?? 'Belum ada deskripsi komunitas.')) !!}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

</section>

{{-- ================= MODAL ================= --}}
<div id="modal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 p-4 backdrop-blur-sm">

    <div class="bg-white rounded-2xl p-6 max-w-lg w-full relative shadow-2xl transform transition-all">

        {{-- Tombol Close --}}
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full w-8 h-8 flex items-center justify-center transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Gambar Modal --}}
        <div class="w-full h-56 mb-5 bg-gray-100 rounded-xl overflow-hidden border border-gray-100">
            <img id="modalImage" class="w-full h-full object-cover hidden">
            <div id="modalNoImage" class="w-full h-full flex items-center justify-center text-gray-400 hidden">
                <span>No Logo</span>
            </div>
        </div>

        {{-- Judul & Deskripsi --}}
        <h3 id="modalTitle" class="text-2xl font-bold mb-2 text-gray-800"></h3>
        <p id="modalDesc" class="text-gray-600 mb-6 leading-relaxed text-sm"></p>

        {{-- Info Tanggal & Anggota (Pakai Ikon) --}}
        <div class="flex flex-col sm:flex-row gap-5 border-t border-gray-100 pt-4 mt-2">
            
            <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                <div class="bg-red-50 p-1.5 rounded-lg text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span id="modalDate"></span>
            </div>

            <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                <div class="bg-red-50 p-1.5 rounded-lg text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span id="modalMember"></span>
            </div>

        </div>

    </div>

</div>

<script>
    const dataKomunitas = @json($komunitas);

    function openModal(id) {
        // Cari data komunitas berdasarkan ID
        const item = dataKomunitas.find(k => k.id === id);

        if (!item) return; // Mencegah error jika data tidak ditemukan

        // Tampilkan Modal
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');

        // PERBAIKAN 2: Penanganan Gambar (menggunakan item.logo bukan item.image)
        const imgElement = document.getElementById('modalImage');
        const noImgElement = document.getElementById('modalNoImage');
        
        if (item.logo) {
            // Asumsi asset() menggunakan root path '/'
            imgElement.src = '/' + item.logo; 
            imgElement.classList.remove('hidden');
            noImgElement.classList.add('hidden');
        } else {
            imgElement.classList.add('hidden');
            noImgElement.classList.remove('hidden');
        }

        // Set Text Konten dengan nilai fallback jika kosong
        document.getElementById('modalTitle').innerText = item.nama_komunitas;
        document.getElementById('modalDesc').innerText = item.deskripsi ? item.deskripsi : 'Belum ada deskripsi komunitas.';
        
        document.getElementById('modalDate').innerText =
            item.created_at
            ? new Date(item.created_at).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            })
            : '-';
        document.getElementById('modalMember').innerText = (item.jumlah_anggota ? item.jumlah_anggota : '0') + ' Anggota';
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
    }
</script>

@endsection