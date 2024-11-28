@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-semibold text-center text-gray-800 mb-6">Konfirmasi Pesanan</h1>

    <h2 class="text-2xl font-medium font-bold text-center text-black-600 mb-8">Pesanan Anda</h2>

    <!-- Cart Items Section -->
    @if($cartItems->isEmpty())
        <p class="text-center text-gray-500">Keranjang Anda kosong.</p>
    @else
        <div class="space-y-4 mb-6">
            @foreach($cartItems as $item)
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="font-medium">{{ $item->menu->nama_menu }} (x{{ $item->quantity }})</span>
                    <span class="font-medium">Rp{{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</span>

                    <!-- Hidden Inputs for quantity and price -->
                    <input type="hidden" name="items[{{ $item->id }}][menu_id]" value="{{ $item->menu->id }}">
                    <input type="hidden" name="items[{{ $item->id }}][quantity]" value="{{ $item->quantity }}">
                    <input type="hidden" name="items[{{ $item->id }}][price]" value="{{ $item->menu->harga * $item->quantity }}">
                </div>
            @endforeach
        </div>

        <div class="text-center mb-6">
            <strong class="text-xl">Total: Rp{{ number_format($total, 0, ',', '.') }}</strong>
        </div>

        <p class="text-lg text-center text-gray-600 mb-8">
            <strong>Jenis Pesanan:</strong> 
            @if(session('type') == 'Dine-in')
                Dine-in (Nomor Meja: {{ session('nomor_meja', 'Tidak ada data') }})
            @else
                Takeaway (Jam Pengambilan: {{ session('jam_pengambilan', 'Tidak ada data') }})
            @endif
        </p>

        <!-- Finalize Order Form -->
        <form action="{{ route('order.finalize') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Hidden Inputs for Cart Items -->
            <input type="hidden" name="cart_ids[]" value="{{ $item->id }}">

            <!-- Input Nama Pembeli -->
            <div>
                <label for="nama" class="block text-lg font-medium text-gray-700">Nama Pembeli:</label>
                <input type="text" name="nama" id="nama" required class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            
            <!-- Input Nomor Telepon -->
            <div>
                <label for="nomor_telepon" class="block text-lg font-medium text-gray-700">Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" required class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Quantity Inputs for Each Cart Item -->
            @foreach($cartItems as $item)
                <input type="hidden" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}">
            @endforeach
            
            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 text-lg font-semibold text-white bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg shadow-lg hover:from-indigo-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 focus:ring-4 focus:ring-indigo-300">
                Konfirmasi Pesanan
            </button>
        </form>
    @endif
</div>
@endsection
