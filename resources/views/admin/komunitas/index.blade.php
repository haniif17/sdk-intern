@extends('layouts.admin')

@section('content')

<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Daftar Pendaftar Komunitas</h1>
    </div>

    {{-- Alert Notifikasi Sukses/Error --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel Daftar Komunitas --}}
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-4 border-b">No</th>
                    <th class="p-4 border-b">Logo</th>
                    <th class="p-4 border-b">Komunitas</th>
                    <th class="p-4 border-b">Ketua / Anggota</th>
                    <th class="p-4 border-b">Tgl Daftar</th>
                    <th class="p-4 border-b text-center">Status</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($komunitas as $index => $item)

                    <tr class="hover:bg-gray-50 border-b last:border-0 transition">

                        <td class="p-4">
                            {{ $index + 1 }}
                        </td>

                        <td class="p-4">
                            @if($item->logo)
                                <img src="{{ asset($item->logo) }}"
                                     class="w-16 h-16 object-cover rounded-lg border shadow-sm">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-500 font-bold">
                                    NO LOGO
                                </div>
                            @endif
                        </td>

                        <td class="p-4">
                            <div class="font-bold text-gray-800 text-lg">
                                {{ $item->nama_komunitas }}
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $item->email }}
                            </div>

                            <div class="text-xs text-gray-400">
                                {{ '@' . $item->username }}
                            </div>
                        </td>

                        <td class="p-4">
                            <div class="font-semibold text-gray-700">
                                {{ $item->nama_ketua }}
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $item->jumlah_anggota }} Orang
                            </div>
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $item->created_at->format('d M Y') }}
                        </td>

                        <td class="p-4 text-center">

                            @if($item->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    Pending
                                </span>

                            @elseif($item->status == 'approved')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    Approved
                                </span>

                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                    Rejected
                                </span>
                            @endif

                        </td>

                        <td class="p-4">

                            <div class="flex items-center justify-center flex-wrap gap-2">

                                @if($item->status == 'pending')

                                    {{-- Approve --}}
                                    <form action="{{ route('admin.komunitas.approve', $item->id) }}"
                                          method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="bg-green-500 text-white px-3 py-1.5 rounded-md hover:bg-green-600 text-sm font-semibold transition shadow-sm">
                                            Approve
                                        </button>

                                    </form>

                                    {{-- Reject --}}
                                    <form action="{{ route('admin.komunitas.reject', $item->id) }}"
                                          method="POST">

                                        @csrf

                                        <button type="submit"
                                            class="bg-orange-500 text-white px-3 py-1.5 rounded-md hover:bg-orange-600 text-sm font-semibold transition shadow-sm">
                                            Reject
                                        </button>

                                    </form>

                                @endif

                                {{-- Edit --}}
                                <a href="{{ route('komunitas.edit', $item->id) }}"
                                   class="bg-blue-500 text-white px-3 py-1.5 rounded-md hover:bg-blue-600 text-sm font-semibold transition shadow-sm">
                                    Edit
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('komunitas.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus komunitas {{ $item->nama_komunitas }} beserta akun loginnya?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1.5 rounded-md hover:bg-red-600 text-sm font-semibold transition shadow-sm">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7"
                            class="p-8 text-center text-gray-500">

                            Belum ada pendaftaran komunitas baru.

                        </td>
                    </tr>

                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection