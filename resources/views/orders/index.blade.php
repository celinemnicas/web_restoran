@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Pesanan</h1>

    <!-- Tabel Pesanan Aktif -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg mb-8">
        <table class="min-w-full table-auto text-sm">
            <thead>
                <tr class="bg-blue-100 text-bold-800 font-bold">
                    <th class="px-6 py-3 text-left">ID Pesanan</th>
                    <th class="px-6 py-3 text-left">Nama Menu</th>
                    <th class="px-6 py-3 text-left">Jenis Pesanan</th>
                    <th class="px-6 py-3 text-left">Nomor Meja</th>
                    <th class="px-6 py-3 text-left">Jam Pengambilan</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Nama Pembeli</th>
                    @if(auth()->check() && auth()->user()->role == 0) <!-- Kolom Aksi hanya untuk role 0 -->

                    <th class="px-6 py-3 text-left">Nomor Telepon</th>
                    <th class="px-6 py-3 text-left">Kuantitas</th> <!-- Kolom Kuantitas -->
                    <th class="px-6 py-3 text-left">Harga</th> <!-- Kolom Harga -->
                    <th class="px-6 py-3 text-left">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-b hover:bg-blue-50 transition-colors duration-300">
                        <td class="px-6 py-4 text-gray-700">{{ $order->id }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->menu->nama_menu }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->jenis_pesanan }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->nomor_meja ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->jam_pengambilan ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-700">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $order->status == 'Selesai' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ json_decode($order->informasi_pembeli)->nama ?? '-' }}</td>
                        @if(auth()->check() && auth()->user()->role == 0) <!-- Aksi Edit hanya untuk role 0 -->
                            <td class="px-6 py-4 text-gray-700">{{ json_decode($order->informasi_pembeli)->nomor_telepon ?? '-' }}</td>
                            
                            <!-- Menampilkan kuantitas dan harga -->
                            <td class="px-6 py-4 text-gray-700">{{ $order->quantity }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $order->price }}</td>
                            <td class="px-6 py-4 text-gray-700">
                                <a href="{{ route('orders.edit', $order->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors duration-200">Edit</a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->check() && auth()->user()->role == 0 ? 11 : 10 }}" 
                            class="px-6 py-4 text-center text-gray-600">Belum ada data pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
