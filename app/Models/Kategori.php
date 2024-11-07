<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = [
        'nama_kategori',
        'ukuran_kamar',
        'harga_per_bulan',
        'fasilitas_id',
        'petugas_id',
        'deskripsi',
        'photo',
    ];

    public function getTotalHargaAttribute()
    {
        $fasilitasPrice = $this->fasilitas ? $this->fasilitas->harga : 0;
        $hargaPerBulan = $this->harga_per_bulan ?? 0;

        return $fasilitasPrice + $hargaPerBulan;
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }


    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}

