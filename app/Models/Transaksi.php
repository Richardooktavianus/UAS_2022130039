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
}
