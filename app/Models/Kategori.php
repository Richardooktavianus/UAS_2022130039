<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'ukuran_kamar',
        'harga_per_bulan',
        'fasilitas',
        'photo',

    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
