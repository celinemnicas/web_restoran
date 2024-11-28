@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Pilih Jenis Pesanan</h1>
    {{-- <h2 class="text-2xl font-medium font-bold text-center text-black-600 mb-8">Menu: {{ $menu->nama_menu }}</h2> --}}

    <!-- Cart Details Section -->
    <h3 class="text-lg font-semibold mb-4">Detail Belanjaan Anda</h3>
@if(count($cartItems) > 0)
    <ul class="space-y-4">
        @foreach($cartItems as $item)
            <li class="flex justify-between items-center border-b pb-2">
                <span class="font-medium">{{ $item->menu->nama_menu }} (x{{ $item->quantity }})</span>
                <span class="font-medium">Rp{{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</span>
            </li>
        @endforeach
    </ul>
    <div class="mt-4">
        <strong class="text-xl">Total: Rp{{ number_format($total, 0, ',', '.') }}</strong>
    </div>
@else
    <p class="text-gray-500">Keranjang Anda kosong. <a href="{{ route('daftar-menu') }}" class="text-blue-500 underline">Lihat menu</a>.</p>
@endif


    <!-- Pilihan Jenis Pesanan -->
    <h2 class="text-2xl font-medium text-center text-black-600 mb-8">Mau makan di tempat atau bawa pulang?</h2>

    <form action="{{ route('order.submit', ['menuId' => $menu->id]) }}" method="POST" id="orderForm" class="w-full space-y-6 bg-gray-50 p-6 rounded-lg shadow-md">
        @csrf

        <!-- Pilihan jenis pesanan -->
        <div>
            <label for="type" class="block text-lg font-medium text-gray-700">Jenis Pesanan:</label>
            <select name="type" id="type" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled selected>Pilih Jenis Pesanan</option>
                <option value="Dine-in">Dine-in</option>
                <option value="Takeaway">Takeaway</option>
            </select>
        </div>

        <!-- Dine-in Input -->
        <div id="dineInInput" class="hidden">
            <label for="nomor_meja" class="block text-lg font-medium text-gray-700">Nomor Meja:</label>
            <input type="number" name="nomor_meja" id="nomor_meja" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500">
        </div>

        <!-- Takeaway Input -->
        <div id="takeAwayInput" class="hidden">
            <label for="jam_pengambilan" class="block text-lg font-medium text-gray-700">Jam Pengambilan:</label>
            <input type="time" name="jam_pengambilan" id="jam_pengambilan" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full py-3 text-lg font-semibold text-white bg-gradient-to-r from-blue-400 to-blue-500 rounded-lg shadow-lg hover:from-blue-500 hover:to-blue-600 transition-all duration-300 transform hover:scale-105 focus:ring-4 focus:ring-blue-300">
            Pesan Sekarang
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const typeSelect = document.getElementById('type');
        const dineInInput = document.getElementById('dineInInput');
        const takeAwayInput = document.getElementById('takeAwayInput');

        typeSelect.addEventListener('change', () => {
            if (typeSelect.value === 'Dine-in') {
                dineInInput.classList.remove('hidden');
                takeAwayInput.classList.add('hidden');
                document.getElementById('nomor_meja').required = true;
                document.getElementById('jam_pengambilan').required = false;
            } else if (typeSelect.value === 'Takeaway') {
                takeAwayInput.classList.remove('hidden');
                dineInInput.classList.add('hidden');
                document.getElementById('jam_pengambilan').required = true;
                document.getElementById('nomor_meja').required = false;
            } else {
                dineInInput.classList.add('hidden');
                takeAwayInput.classList.add('hidden');
                document.getElementById('nomor_meja').required = false;
                document.getElementById('jam_pengambilan').required = false;
            }
        });
    });
</script>
@endsection
