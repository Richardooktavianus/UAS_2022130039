@extends('layouts.template')

@section('title', 'Daftar Kamar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Kamar</h1>
    <a href="{{ route('kamar.create') }}" class="btn btn-primary">Tambah Kamar</a>
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
            <th>Nama Kamar</th>
            <th>Tipe Kamar</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kamars as $kamar)
        <tr>
            <td>{{ $kamar->id }}</td>
            <td>{{ $kamar->nama_kamar }}</td>
            <td>{{ $kamar->tipeKamar->nama_tipe }}</td>
            <td>{{ $kamar->deskripsi }}</td>
            <td>{{ $kamar->status ? 'Tersedia' : 'Tidak Tersedia' }}</td>
            <td>
                <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" style="display:inline;">
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
