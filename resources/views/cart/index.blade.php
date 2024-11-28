@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Keranjang Belanja</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- @if($cartItems->isEmpty())
        <p class="text-gray-500">Keranjang Anda kosong. <a href="{{ route('daftar-menu') }}" class="text-blue-500 underline">Lihat menu</a>.</p>
    @else --}}
        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2">Menu</th>
                    <th class="border-b px-4 py-2">Harga</th>
                    <th class="border-b px-4 py-2">Jumlah</th>
                    <th class="border-b px-4 py-2">Subtotal</th>
                    <th class="border-b px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td class="border-b px-4 py-2">
                            {{ $item->menu->nama_menu }}
                            <p class="text-gray-500 text-sm">{{ $item->menu->kategori->nama_kategori }}</p>
                        </td>
                        <td class="border-b px-4 py-2">Rp{{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                        <td class="border-b px-4 py-2">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 p-2 border rounded text-center">
                                <button type="submit" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Update</button>
                            </form>
                        </td>
                        <td class="border-b px-4 py-2">Rp{{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</td>
                        <td class="border-b px-4 py-2 text-center">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
            </tbody>
            @endforeach

        </table>
        <div class="flex justify-left mt-10">
            <a href="{{ url('/daftar-menu') }}" 
               class="inline-block px-6 py-3 text-white bg-gradient-to-r from-gray-500 to-gray-600 rounded-lg shadow-md hover:from-gray-600 hover:to-gray-500 transition-colors duration-300 font-semibold">
                Kembali ke Menu
            </a>
        </div>
        <div class="mt-6 text-right">
            
            <h3 class="text-xl font-bold">Total: Rp{{ number_format($total, 0, ',', '.') }}</h3>
            <br>
            <br>
            <a href="{{ route('order.choose', ['menuId' => $item->menu->id]) }}" class="w-full py-3 px-6 text-center text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-500 transition-colors duration-300 font-semibold shadow-md hover:shadow-lg">
                <span>Beli Sekarang</span>
            </a>
        </div>

    {{-- @endif --}}
</div>
@endsection
