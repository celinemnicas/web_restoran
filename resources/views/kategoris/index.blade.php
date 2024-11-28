@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Kategori</h1>
    
    <!-- Tombol Tambah Kategori -->
    <a href="{{ route('kategoris.create') }}" class="inline-block px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Tambah Kategori
    </a>
    
    <!-- Tabel Daftar Kategori -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">No</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nama Kategori</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $kategori)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $kategori->nama_kategori }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        <a href="{{ route('kategoris.edit', $kategori) }}" class="px-3 py-1 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">Edit</a>
                        <form action="{{ route('kategoris.destroy', $kategori) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 ml-2 text-xs text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
