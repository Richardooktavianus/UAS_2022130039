<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_id',
        'penghuni_id',
        'tanggal_mulai',
        'tanggal_akhir',
        'lama_sewa',
        'jumlah_harga',
    ];

    protected static function booted()
    {
        static::saving(function ($sewa) {
            if ($sewa->tanggal_mulai && $sewa->tanggal_akhir) {
                $sewa->lama_sewa = Carbon::parse($sewa->tanggal_mulai)
                    ->diffInMonths(Carbon::parse($sewa->tanggal_akhir));
            }

            if ($sewa->kamar && $sewa->kamar->kategori) {
                $totalHargaPerBulan = $sewa->kamar->kategori->total_harga;

                $sewa->jumlah_harga = $sewa->lama_sewa * $totalHargaPerBulan;
            }
        });
    }

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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
