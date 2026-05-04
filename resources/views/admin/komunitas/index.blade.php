@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Daftar Komunitas
    </h1>

    {{-- Button Tambah --}}
    <a href="{{ url('/admin/komunitas/create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + Tambah Komunitas
    </a>

    {{-- Tabel Daftar Komunitas --}}
    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Gambar</th>
                <th class="p-3 border">Nama Komunitas</th>
                <th class="p-3 border">Tanggal Gabung</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($komunitas as $index => $item)
                <tr>
                    <td class="p-3 border">{{ $index + 1 }}</td>
                    <td class="p-3 border">
                        <img src="{{ asset($item->image) }}" class="w-20 h-20 object-cover rounded">
                    </td>
                    <td class="p-3 border">{{ $item->nama_komunitas }}</td>
                    <td class="p-3 border">{{ \Carbon\Carbon::parse($item->tanggal_gabung)->format('d M Y') }}</td>
                    <td class="p-3 border">
                        <a href="{{ url('/admin/komunitas/'.$item->id.'/edit') }}" class="text-blue-500">Edit</a> |
                        <form action="{{ url('/admin/komunitas/'.$item->id) }}" method="POST" class="inline" onsubmit="return confirmDelete('{{ $item->nama_komunitas }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
    function confirmDelete(name) {
        return confirm("Yakin ingin menghapus komunitas: " + name + "?");
    }
</script>

@endsection