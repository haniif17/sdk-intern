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
                    <div class="border-2 border-black/30 rounded-2xl p-8 min-h-[220px]
                                shadow-sm hover:shadow-xl hover:border-black
                                transition-all duration-300 ease-out">

                        <img src="{{ asset($item->image) }}"
                             class="w-full h-[150px] object-cover rounded-2xl mb-4">

                        <h3 class="text-lg font-semibold text-center">
                            {{ $item->title }}
                        </h3>

                        <p class="text-sm text-gray-600 text-center mt-2">
                            {{ $item->description }}
                        </p>
                    </div>
                @endforeach

            </div>

           

        </div>
    </section>

@endsection