@extends('layouts.template')

@section('title', 'Edit Kamar')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Kamar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_kamar" class="form-label">Nama Kamar</label>
                <input type="text" class="form-control" id="nama_kamar" name="nama_kamar" required value="{{ old('nama_kamar', $kamar->nama_kamar) }}">
            </div>
            <div class="mb-3">
                <label for="tipe_kamar_id" class="form-label">Tipe Kamar</label>
                <select class="form-select" id="tipe_kamar_id" name="tipe_kamar_id" required>
                    <option value="">Pilih Tipe Kamar</option>
                    @foreach($tipe_kamars as $tipe_kamar)
                        <option value="{{ $tipe_kamar->id }}" {{ $kamar->tipe_kamar_id == $tipe_kamar->id ? 'selected' : '' }}>
                            {{ $tipe_kamar->nama_tipe }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="1" {{ $kamar->status == 1 ? 'selected' : '' }}>Tersedia</option>
                    <option value="0" {{ $kamar->status == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                @if($kamar->photo)
                    <img src="{{ asset('storage/' . $kamar->photo) }}" alt="Current photo" class="mt-2" style="width: 100px;">
                    <p>Current photo</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
