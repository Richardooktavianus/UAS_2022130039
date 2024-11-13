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
        'keterangan',
        'status_pembayaran',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }

    public function penghuni()
    {
        return $this->hasOneThrough(Penghuni::class, Sewa::class, 'id', 'id', 'sewa_id', 'penghuni_id');
    }

    public function kategori()
    {
        return $this->belongsToThrough(Kategori::class, Sewa::class, 'sewa_id', 'id', 'id', 'kategori_id');
    }

    public function getJumlahBayarAttribute()
    {
        return $this->sewa->kategori->total_harga ?? 0;
    }
}

