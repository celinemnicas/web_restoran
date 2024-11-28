@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Data Restoran</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Kategori Menu</th>
                <th>Nama Menu</th>
                <th>Status Pesanan</th>
                <th>Jumlah Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataRestoran as $data)
                <tr>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->kategori->nama_kategori }}</td>
                    <td>{{ $data->menu->nama_menu }}</td>
                    <td>{{ $data->status_pesanan }}</td>
                    <td>{{ $data->quantity ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
