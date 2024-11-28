@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Kategori</h1>
    
    <!-- Form Edit Kategori -->
    <form action="{{ route('kategoris.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Input Nama Kategori -->
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori:</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $kategori->nama_kategori }}" required
                class="mt-1 px-4 py-2 w-full text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        
        <!-- Tombol Update dan Batal -->
        <div class="flex items-center space-x-4">
            <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update
            </button>
            <a href="{{ route('kategoris.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection