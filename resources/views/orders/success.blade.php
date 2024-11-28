@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Pesanan Berhasil</h1>

    <div class="space-y-6">
        <div>
            <h3 class="text-2xl font-medium text-gray-700 mb-4">Status Pesanan</h3>
            <p class="text-lg text-gray-600"><strong>Status:</strong> <span class="font-semibold text-indigo-600">{{ $order->status }}</span></p>
        </div>

        <div>
            @if($order->jenis_pesanan == 'Dine-in')
                <p class="text-lg text-gray-600"><strong>Nomor Meja:</strong> <span class="font-semibold text-gray-800">{{ $order->nomor_meja }}</span></p>
            @elseif($order->jenis_pesanan == 'Takeaway')
                <p class="text-lg text-gray-600"><strong>Jam Pengambilan:</strong> <span class="font-semibold text-gray-800">{{ $order->jam_pengambilan }}</span></p>
            @endif
        </div>
    </div>

    <div class="mt-10 text-center">
        <h4 class="text-xl font-semibold text-gray-700 mb-6">Lakukan Pembayaran dan Pengambilan Menu di Kasir Apabila Pesanan Telah Selesai</h4>
        <a href="{{ route('orders.index') }}" class="inline-block px-8 py-2 text-lg font-semibold text-white bg-indigo-600 rounded-lg shadow-lg hover:bg-indigo-700 transition-all duration-300 focus:ring-4 focus:ring-indigo-300">
                Lihat Antrian
        </a>
    </div>
</div>
@endsection
