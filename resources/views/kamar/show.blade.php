@extends('layouts.template')

@section('title', 'Detail Kamar')

@section('content')
<div class="container">
    <h2>{{ $kamar->nama_kamar }} (ID: {{ str_pad($kamar->id, 4, '0', STR_PAD_LEFT) }})</h2>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $kamar->photo ? asset('storage/' . $kamar->photo) : 'https://via.placeholder.com/150' }}"
                     class="img-fluid rounded-start"
                     alt="{{ $kamar->nama_kamar }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Tipe Kamar: {{ $kamar->tipeKamar->nama_tipe }}</h5>
                    <p class="card-text"><strong>Deskripsi:</strong> {{ $kamar->deskripsi }}</p>
                    <p class="card-text"><strong>Harga per Bulan:</strong> Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ $kamar->status ? 'Tersedia' : 'Tidak Tersedia' }}</p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('kamar.edit', $kamar->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Kembali ke Daftar Kamar</a>
</div>
@endsection

