@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Daftar Kegiatan
    </h1>

    <a href="{{ url('/admin/kegiatan/create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + Tambah Kegiatan
    </a>

    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Tanggal</th>
                <th class="p-3 border">Nama Kegiatan</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatans as $index => $kegiatan)
                <tr>
                    <td class="p-3 border">{{ $index + 1 }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</td>
                    <td class="p-3 border">{{ $kegiatan->nama_kegiatan }}</td>
                    <td class="p-3 border">
                        <a href="{{ url('/admin/kegiatan/'.$kegiatan->id.'/edit') }}" class="text-blue-500">Edit</a> |
                        <form action="{{ url('/admin/kegiatan/'.$kegiatan->id) }}" method="POST" class="inline" onsubmit="return confirmDelete('{{ $kegiatan->nama_kegiatan }}')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

<script>
    function confirmDelete(title) {
        return confirm("Yakin ingin menghapus kegiatan: " + title + "?");
    }
</script>