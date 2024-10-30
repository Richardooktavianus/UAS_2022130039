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
                <input type="text" class="form-control @error('nama_tipe') is-invalid @enderror" id="nama_tipe" name="nama_tipe" value="{{ old('nama_tipe') }}" required>
                @error('nama_tipe')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga_per_bulan" class="form-label">Harga per bulan</label>
                <input type="number" class="form-control @error('harga_per_bulan') is-invalid @enderror" id="harga_per_bulan" name="harga_per_bulan" value="{{ old('harga_per_bulan') }}" required min="1">
                @error('harga_per_bulan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tipe_kamar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @if(session('errors'))
            <div class="alert alert-danger mt-3">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

