<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'penyewaan_id',
        'tanggal_bayar',
        'jumlah',
        'status_pembayaran'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class);
    }
}
