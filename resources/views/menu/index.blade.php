@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-10">Daftar Menu Restoran</h1>

    <!-- Tautan ke Keranjang -->
    {{-- <div class="flex justify-end mb-6">
        <a href="{{ route('cart.index') }}" 
           class="inline-block px-6 py-3 text-white bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-md hover:from-green-600 hover:to-green-500 transition-colors duration-300 font-semibold">
            Lihat Keranjang
        </a>
    </div> --}}
 
    <div class="flex">
        <!-- Sidebar Kategori -->
        <div class="w-1/4 p-4 border-r-4 border-gray-400">
            <h2 class="text-xl font-semibold mb-4">Kategori</h2>
            <ul class="space-y-2">
                <!-- Tampilkan semua menu -->
                <li class="bg-white rounded-lg hover:bg-blue-100 transition-colors duration-300 shadow-sm">
                    <a href="{{ route('daftar-menu') }}" 
                       class="block px-4 py-2 text-gray-700 hover:text-blue-600 {{ !isset($kategoriId) ? 'font-bold text-blue-600 bg-blue-200' : '' }}">
                        Semua Menu
                    </a>
                </li>
                <!-- Tampilkan menu per kategori -->
                @foreach ($kategoris as $kategori)
                    <li class="bg-white rounded-lg hover:bg-blue-100 transition-colors duration-300 shadow-sm">
                        <a href="{{ route('daftar-menu', ['kategori_id' => $kategori->id]) }}" 
                           class="block px-4 py-2 text-gray-700 hover:text-blue-600 {{ (isset($kategoriId) && $kategoriId == $kategori->id) ? 'font-bold text-blue-600 bg-blue-200' : '' }}">
                            {{ $kategori->nama_kategori }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    
        <!-- Daftar Menu -->
        <div class="w-3/4 p-4">
            @if($menus->isEmpty())
                <p class="text-gray-500">Tidak ada menu yang ditemukan untuk kategori ini.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($menus as $menu)
                        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                            <div class="relative">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $menu->nama_menu }}</h2>
                                
                                <p class="text-gray-600 text-sm mb-2"><strong>Kategori:</strong> {{ $menu->kategori->nama_kategori }}</p>
                                <p class="text-gray-600 text-sm mb-4"><strong>Harga:</strong> Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                                <p class="text-gray-700 mb-6 text-sm">{{ $menu->deskripsi }}</p>
                                
                                <!-- Gambar Menu -->
                                @if($menu->gambar)
                                    <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                @else
                                    <div class="h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                
                                <!-- Form untuk menambahkan item ke keranjang -->
                                <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="w-full py-1 px-6 text-center text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-500 transition-colors duration-300 font-semibold shadow-md hover:shadow-lg">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Masukkan ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

   
</div>
@endsection
