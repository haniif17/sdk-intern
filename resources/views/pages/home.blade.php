@extends('layouts.app')

@section('content')

    {{-- HERO --}}
    <section class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid md:grid-cols-2 gap-6 items-center">

            {{-- LEFT IMAGE --}}
            <div class="relative">
                <img src="https://via.placeholder.com/800x500"
                     class="rounded-2xl w-full object-cover">

                <div class="absolute bottom-6 left-6 text-white">
                    <h1 class="text-3xl md:text-5xl font-bold leading-tight">
                        
                    </h1>

                    <div class="mt-4 flex space-x-3">
                        <a href="#" class="bg-red-500 px-4 py-2 rounded-full text-white">
                            Pesan Ruangan
                        </a>
                        <a href="#" class="border border-white px-4 py-2 rounded-full text-white">
                            Detail Lengkap
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT TEXT --}}
            <div class="bg-gray-100 rounded-2xl p-6">
                <p class="text-gray-600">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore.
                </p>
            </div>

        </div>
    </section>

@endsection