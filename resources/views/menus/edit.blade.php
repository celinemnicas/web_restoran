@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Menu</h1>

    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Nama Menu -->
        <div>
            <label for="nama_menu" class="block text-lg font-medium text-gray-700 mb-2">Nama Menu</label>
            <input 
                type="text" 
                name="nama_menu" 
                id="nama_menu" 
                value="{{ old('nama_menu', $menu->nama_menu) }}" 
                required 
                class="block w-full p-3 rounded-lg border-gray-300 shadow-md text-base focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Masukkan nama menu">
        </div>

        <!-- Harga -->
        <div>
            <label for="harga" class="block text-lg font-medium text-gray-700 mb-2">Harga</label>
            <input 
                type="number" 
                name="harga" 
                id="harga" 
                value="{{ old('harga', $menu->harga) }}" 
                required 
                class="block w-full p-3 rounded-lg border-gray-300 shadow-md text-base focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Masukkan harga menu">
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-lg font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea 
                name="deskripsi" 
                id="deskripsi" 
                rows="4" 
                class="block w-full p-3 rounded-lg border-gray-300 shadow-md text-base focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Tuliskan deskripsi menu">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori_id" class="block text-lg font-medium text-gray-700 mb-2">Kategori</label>
            <select 
                name="kategori_id" 
                id="kategori_id" 
                required 
                class="block w-full p-3 rounded-lg border-gray-300 shadow-md text-base focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" 
                        {{ $kategori->id == old('kategori_id', $menu->kategori_id) ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Gambar Menu -->
        <div>
            <label for="gambar" class="block text-lg font-medium text-gray-700 mb-2">Gambar Menu</label>
            <input 
                type="file" 
                name="gambar" 
                id="gambar" 
                class="block w-full p-3 rounded-lg border-gray-300 shadow-md text-base focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">

            @if($menu->gambar)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="max-w-xs h-auto">
                </div>
            @endif
        </div>

        <!-- Tombol Simpan Perubahan -->
        <div class="flex justify-end space-x-6">
            <a href="{{ route('menus.index') }}" class="px-6 py-3 text-lg font-semibold text-gray-700 bg-gray-200 rounded-lg shadow hover:bg-gray-300">Batal</a>
            <button 
                type="submit" 
                class="px-6 py-3 text-lg font-semibold text-white bg-indigo-600 rounded-lg shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
