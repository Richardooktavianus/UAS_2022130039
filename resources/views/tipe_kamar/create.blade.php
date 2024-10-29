@extends('layouts.template')

@section('title', 'Tambah Tipe Kamar')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Tipe Kamar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('tipe_kamar.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_tipe" class="form-label">Nama Tipe</label>
                <input type="text" class="form-control" id="nama_tipe" name="nama_tipe" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tipe_kamar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
