@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-4xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">
            Edit Data Booking (Approved)
        </h1>
        <a href="{{ route('admin.booking.index') }}" class="text-gray-500 hover:text-gray-800 hover:underline text-sm">
            &larr; Kembali ke Tabel
        </a>
    </div>

    {{-- Alert kalau ada error jadwal bentrok --}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 font-medium">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border p-6">
        <form action="{{ route('admin.booking.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Nama Kegiatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan', $booking->nama_kegiatan) }}" required
                           class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                </div>

                {{-- Nama Komunitas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Komunitas</label>
                    <input type="text" name="nama_komunitas" value="{{ old('nama_komunitas', $booking->nama_komunitas) }}" required
                           class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $booking->tanggal) }}" required
                           class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Waktu --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                    <select name="waktu" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="">-- Pilih Waktu --</option>
                        <option value="09:00-12:00" {{ old('waktu', $booking->waktu) == '09:00-12:00' ? 'selected' : '' }}>09:00-12:00</option>
                        <option value="13:00-16:00" {{ old('waktu', $booking->waktu) == '13:00-16:00' ? 'selected' : '' }}>13:00-16:00</option>
                        <option value="15:00-18:00" {{ old('waktu', $booking->waktu) == '15:00-18:00' ? 'selected' : '' }}>15:00-18:00</option>
                    </select>
                </div>

                {{-- Ruangan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                    <select name="ruangan" required class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="">-- Pilih Ruangan --</option>
                        <option value="Ruangan Kecil(5-10 orang)" {{ old('ruangan', $booking->ruangan) == 'Ruangan Kecil(5-10 orang)' ? 'selected' : '' }}>Ruangan Kecil(5-10 orang)</option>
                        <option value="Ruangan Besar (11-30 orang)" {{ old('ruangan', $booking->ruangan) == 'Ruangan Besar (11-30 orang)' ? 'selected' : '' }}>Ruangan Besar (11-30 orang)</option>
                    </select>
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP Penanggung Jawab</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $booking->no_hp) }}" required
                           class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3 border-t pt-5">
                {{-- Tombol Batal (Merah) --}}
                <a href="{{ route('admin.booking.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-md transition duration-150 shadow-sm">
                    Batal
                </a>

                {{-- Tombol Simpan (Hijau) --}}
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-md transition duration-150 shadow-sm">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</div>

@endsection