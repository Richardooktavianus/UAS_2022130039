<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;


    protected $fillable = [
        'kamar_id',
        'penghuni_id',
        'tanggal_mulai' => 'date',
        'tanggal_akhir' => 'date',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
