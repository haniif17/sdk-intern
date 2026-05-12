@extends('layouts.admin')

@section('content')

<div class="p-6">

    {{-- ================= TABEL 1: LOG SEMUA BOOKING ================= --}}
    <h1 class="text-2xl font-semibold mb-4 text-gray-800">
        Riwayat Semua Booking (Log)
    </h1>

    <table class="w-full border mt-4 mb-10 shadow-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama Kegiatan</th>
                <th class="p-3 border">Nama Komunitas</th>
                <th class="p-3 border">Tanggal</th>
                <th class="p-3 border">Waktu</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Log</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $index => $booking)
                <tr>
                    <td class="p-3 border text-center">{{ $index + 1 }}</td>
                    <td class="p-3 border">{{ $booking->nama_kegiatan }}</td>
                    <td class="p-3 border">{{ $booking->nama_komunitas }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                    <td class="p-3 border">{{ $booking->waktu }}</td>
                    
                    <td class="p-3 border font-semibold 
                        @if($booking->status == 'approved') text-green-500 
                        @elseif($booking->status == 'rejected') text-red-500 
                        @else text-yellow-500 @endif">
                        {{ ucfirst($booking->status) }}
                    </td>

                    <td class="p-3 border text-sm text-gray-600">{{ $booking->log ?? 'Belum ada log' }}</td> 

                    <td class="p-3 border whitespace-nowrap">
                        @if($booking->status == 'pending')
                            <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST" class="inline">
                                @csrf
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">Approve</button>
                            </form>
                            <form action="{{ route('admin.booking.reject', $booking->id) }}" method="POST" class="inline ml-1">
                                @csrf
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">Reject</button>
                            </form>
                        @else
                            <span class="text-gray-500 italic text-sm">Selesai diproses</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pembatas biar rapi --}}
    <hr class="border-t-2 border-gray-200 my-8">

    {{-- ================= TABEL 2: KHUSUS YANG SUDAH BOOKED ================= --}}
    <h1 class="text-2xl font-semibold mb-4 text-green-600">
        Daftar Ruangan Ter-Booking (Approved)
    </h1>

    <table class="w-full border mt-4 mb-10 shadow-sm">
        <thead>
            <tr class="bg-green-50">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama Kegiatan</th>
                <th class="p-3 border">Nama Komunitas</th>
                <th class="p-3 border">Tanggal</th>
                <th class="p-3 border">Waktu</th>
                <th class="p-3 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookedList as $index => $booked)
                <tr>
                    <td class="p-3 border text-center">{{ $index + 1 }}</td>
                    <td class="p-3 border">{{ $booked->nama_kegiatan }}</td>
                    <td class="p-3 border">{{ $booked->nama_komunitas }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($booked->tanggal)->format('d M Y') }}</td>
                    <td class="p-3 border">{{ $booked->waktu }}</td>
                    
                    <td class="p-3 border whitespace-nowrap text-center">
                        <a href="{{ route('admin.booking.edit', $booked->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-md text-sm inline-block">Edit</a>
                        
                        <form action="{{ route('admin.booking.destroy', $booked->id) }}" method="POST" class="inline ml-1" onsubmit="return confirm('Yakin ingin menghapus data Booked ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-5 border text-center text-gray-500 italic">Belum ada ruangan yang berstatus Approved/Booked.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pembatas --}}
    <hr class="border-t-2 border-gray-200 my-8">

    {{-- ================= TABEL 3: MANAJEMEN HARI LIBUR ================= --}}
    <h1 class="text-2xl font-semibold mb-4 text-blue-600">
        Manajemen Hari Libur Nasional
    </h1>

    <div class="bg-blue-50/30 p-6 rounded-lg border border-blue-100 shadow-sm mb-10">
        {{-- Form Bulk Import --}}
        <form action="{{ route('holidays.bulk') }}" method="POST" class="mb-8">
            @csrf
            <label class="block mb-2 font-semibold text-gray-700">Bulk Import Data Libur</label>
            <p class="text-xs text-gray-500 mb-2 italic text-blue-600">
                Format Baru: <strong class="underline">Tanggal-Bulan-Tahun/Keterangan</strong> (Contoh: 17-08-2026/Hari Kemerdekaan)
            </p>
            <textarea name="data_libur" rows="4" 
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white"
                placeholder="17-08-2026/Hari Kemerdekaan
25-12-2026/Hari Raya Natal"></textarea>
            <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-md text-sm font-medium transition shadow-sm">
                Proses Data Libur
            </button>
        </form>

        {{-- Tabel Daftar Libur --}}
        <div class="bg-white rounded-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-3 text-left font-semibold">Tanggal</th>
                        <th class="p-3 text-left font-semibold">Keterangan</th>
                        <th class="p-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $allHolidays = \App\Models\Holiday::orderBy('tanggal', 'asc')->get(); @endphp
                    @forelse($allHolidays as $h)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 text-gray-700 font-mono">{{ \Carbon\Carbon::parse($h->tanggal)->format('d-m-Y') }}</td>
                            <td class="p-3 text-gray-700">{{ $h->keterangan }}</td>
                            <td class="p-3 text-center">
                                <form action="{{ route('holidays.destroy', $h->id) }}" method="POST" onsubmit="return confirm('Hapus hari libur ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-5 text-center text-gray-400 italic">Belum ada data hari libur nasional.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection