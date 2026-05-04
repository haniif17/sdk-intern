@extends('layouts.app')

@section('content')

<section class="px-6 py-12">
    <div class="max-w-7xl mx-auto">

        {{-- TITLE --}}
        <h2 class="text-4xl md:text-5xl font-semibold text-center mb-10">
            Fasilitas Kami
        </h2>

        {{-- LIST --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            @foreach($fasilitas as $item)
                <div onclick="openModal(
                        '{{ asset($item->image) }}',
                        '{{ addslashes($item->title) }}',
                        `{{ addslashes($item->description) }}`
                    )"
                     class="cursor-pointer border-2 border-black/30 rounded-2xl p-8 min-h-[220px]
                            shadow-sm hover:shadow-xl hover:border-black
                            hover:scale-105 transition-all duration-300 ease-out">

                    <img src="{{ asset($item->image) }}"
                         class="w-full h-[150px] object-cover rounded-2xl mb-4">

                    <h3 class="text-lg font-semibold text-center">
                        {{ $item->title }}
                    </h3>

                    <p class="text-sm text-gray-600 text-center mt-2">
                        {{ \Illuminate\Support\Str::limit($item->description, 80) }}
                    </p>
                </div>
            @endforeach

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

        <h3 id="modalTitle" class="text-2xl font-semibold mb-2 text-center"></h3>

        <p id="modalDesc" class="text-gray-600 text-center"></p>

    </div>

</div>

<script>
    function openModal(image, title, desc) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');

        document.getElementById('modalImage').src = image;
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalDesc').innerText = desc;

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