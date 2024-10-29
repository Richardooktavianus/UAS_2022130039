@extends('layouts.template')

@section('title', 'Daftar Tipe Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Tipe Kamar</h1>
    <a href="{{ route('tipe_kamar.create') }}" class="btn btn-primary">Tambah Tipe Kamar</a>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tipe</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tipe_kamars as $tipe_kamar)
        <tr>
            <td>{{ $tipe_kamar->id }}</td>
            <td>{{ $tipe_kamar->nama_tipe }}</td>
            <td>{{ $tipe_kamar->deskripsi }}</td>
            <td>
                <a href="{{ route('tipe_kamar.edit', $tipe_kamar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tipe_kamar.destroy', $tipe_kamar->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
