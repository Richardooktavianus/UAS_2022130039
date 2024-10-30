@extends('layouts.template')

@section('title', 'Selamat Datang')

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-4">Selamat Datang di Manajemen Kos-Kosan</h1>
    <p class="lead">Kelola kamar, penghuni, dan transaksi dengan mudah.</p>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Kamar Tersedia</h2>
    <div class="row">
        @if(count($kamars) > 0)
            @foreach($kamars as $kamar)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('storage/' . $kamar->photo) }}" class="card-img-top" alt="{{ $kamar->nama_kamar }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kamar->nama_kamar }}</h5>
                            <p class="card-text">{{ Str::limit($kamar->deskripsi, 100) }}</p>
                            <p class="text-primary fw-bold">Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }} / bulan</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('kamar.show', $kamar->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p class="text-center">Tidak ada kamar tersedia saat ini.</p>
            </div>
        @endif
    </div>
</div>
@endsection

