@extends('layouts.app')

@section('content')
<h1>Daftar Kategori</h1>
<a href="{{ route('kategoris.create') }}">Tambah Kategori</a>
<ul>
    @foreach($kategoris as $kategori)
    <li>{{ $kategori->nama_kategori }}
        <a href="{{ route('kategoris.edit', $kategori) }}">Edit</a>
        <form action="{{ route('kategoris.destroy', $kategori) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </li>
    @endforeach
</ul>
@endsection
