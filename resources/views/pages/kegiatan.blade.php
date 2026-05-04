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
                    <a href="#"
                       class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-full text-sm">
                        Detail
                    </a>
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

@endsection