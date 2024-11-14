<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'sewa_id',
        'penghuni_id',
        'tanggal_transaksi',
        'jumlah_bayar',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function getJumlahBayarAttribute()
    {
        $kategoriHarga = $this->sewa->kategori->total_harga ?? 0;
        $lamaSewa = $this->sewa->lama_sewa ?? 1;

        return $kategoriHarga * $lamaSewa;
    }
}
