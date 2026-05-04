@extends('layouts.admin')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-semibold mb-4">
        Data Fasilitas
    </h1>

    <a href="{{ url('/admin/fasilitas/create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">
        + Tambah Fasilitas
    </a>

    <table class="w-full border mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Gambar</th>
                <th class="p-3 border">Judul</th>
                <th class="p-3 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fasilitas as $index => $item)
                <tr>
                    <td class="p-3 border">{{ $index + 1 }}</td>

                    <td class="p-3 border">
                        <img src="{{ asset($item->image) }}" class="w-20 h-20 object-cover rounded">
                    </td>

                    <td class="p-3 border">
                        {{ $item->title }}
                    </td>

                    <td class="p-3 border">
                        <a href="{{ url('/admin/fasilitas/'.$item->id.'/edit') }}"
                           class="text-blue-500">Edit</a>

                        |

                        <!-- Tombol Hapus dengan konfirmasi -->
                        <form action="{{ url('/admin/fasilitas/'.$item->id) }}" method="POST" class="inline" onsubmit="return confirmDelete('{{ $item->title }}')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">
                                Hapus
                            </button>
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
        return confirm("Yakin ingin menghapus fasilitas: " + title + "?");
    }
</script>