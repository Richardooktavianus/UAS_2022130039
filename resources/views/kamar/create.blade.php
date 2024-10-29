@extends('layouts.template')

@section('title', 'Tambah Kamar')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Kamar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kamar.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_kamar" class="form-label">Nama Kamar</label>
                <input type="text" class="form-control" id="nama_kamar" name="nama_kamar" required>
            </div>
            <div class="mb-3">
                <label for="tipe_kamar_id" class="form-label">Tipe Kamar</label>
                <select class="form-select" id="tipe_kamar_id" name="tipe_kamar_id" required>
                    <option value="">Pilih Tipe Kamar</option>
                    @foreach($tipe_kamars as $tipe_kamar)
                        <option value="{{ $tipe_kamar->id }}">{{ $tipe_kamar->nama_tipe }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="1">Tersedia</option>
                    <option value="0">Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
