@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Menu</h1>
    
    <!-- Tombol Tambah Menu -->
    <a href="{{ route('menus.create') }}" class="inline-block px-4 py-2 mb-4 text-sm font-medium text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Tambah Menu
    </a>
    
    <!-- Tabel Daftar Menu -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">No</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nama Menu</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Harga</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Gambar</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $menu->nama_menu }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $menu->kategori->nama_kategori }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $menu->deskripsi }}</td>

                    <!-- Gambar Menu -->
                    <td class="px-4 py-2 text-sm text-gray-700">
                        @if($menu->gambar)
                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="max-w-xs h-auto rounded-sm shadow-sm">
                        @else
                        <span class="text-gray-500">No Image</span>
                        @endif
                    </td>

                    <!-- Aksi -->
                    <td class="px-4 py-2 text-sm text-gray-700">
                    <div class="flex space-x-2">
                        <a href="{{ route('menus.edit', $menu) }}" 
                        class="px-3 py-1 text-xs text-white bg-yellow-500 rounded-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                            Edit
                        </a>

                        <form action="{{ route('menus.destroy', $menu) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-3 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
