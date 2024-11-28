@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pesanan</h1>

        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Jenis Pesanan -->
            <div>
                <label for="jenis_pesanan" class="block text-sm font-medium text-gray-700">Jenis Pesanan</label>
                <select name="jenis_pesanan" id="jenis_pesanan" required
                    class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    onchange="toggleFields()">
                    <option value="Dine-in" {{ $order->jenis_pesanan == 'Dine-in' ? 'selected' : '' }}>Dine-in</option>
                    <option value="Takeaway" {{ $order->jenis_pesanan == 'Takeaway' ? 'selected' : '' }}>Takeaway</option>
                </select>
                @error('jenis_pesanan')
                    <div class="text-orange-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor Meja (Hanya muncul untuk Dine-in) -->
            <div id="nomor_meja_field" class="{{ $order->jenis_pesanan == 'Takeaway' ? 'hidden' : '' }}">
                <label for="nomor_meja" class="block text-sm font-medium text-gray-700">Nomor Meja</label>
                <input type="number" name="nomor_meja" id="nomor_meja" value="{{ $order->nomor_meja }}"
                    class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('nomor_meja')
                    <div class="text-orange-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jam Pengambilan (Hanya muncul untuk Takeaway) -->
            <div id="jam_pengambilan_field" class="{{ $order->jenis_pesanan == 'Dine-in' ? 'hidden' : '' }}">
                @php
                    $date = new DateTime("$order->jam_pengambilan");
                @endphp
                <label for="jam_pengambilan" class="block text-sm font-medium text-gray-700">Jam Pengambilan</label>
                <input type="time" name="jam_pengambilan" id="jam_pengambilan" value="{{ $date->format("H:i") }}"
                    class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('jam_pengambilan')
                    <div class="text-orange-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Proses" {{ $order->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Siap Saji" {{ $order->status == 'Siap Saji' ? 'selected' : '' }}>Siap Saji</option>
                </select>
                @error('status')
                    <div class="text-orange-500">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    <script>
        // Function to toggle visibility of fields based on the jenis_pesanan selection
        function toggleFields() {
            const jenisPesanan = document.getElementById('jenis_pesanan').value;
            const nomorMejaField = document.getElementById('nomor_meja_field');
            const nomorMejaInput = document.getElementById('nomor_meja');
            const jamPengambilanField = document.getElementById('jam_pengambilan_field');
            const jamPengambilanInput = document.getElementById('jam_pengambilan');
    
            if (jenisPesanan === 'Dine-in') {
                nomorMejaField.classList.remove('hidden');
                jamPengambilanField.classList.add('hidden');
                jamPengambilanInput.value = '';  // Reset jam pengambilan saat Dine-in dipilih
            } else if (jenisPesanan === 'Takeaway') {
                nomorMejaField.classList.add('hidden');
                jamPengambilanField.classList.remove('hidden');
                nomorMejaInput.value = '';  // Kosongkan nilai jam pengambilan saat Takeaway dipilih
            }
        }
    
        // Call the toggle function on page load to set the correct initial state
        window.onload = function() {
            toggleFields();
        };
    </script>
        
@endsection
