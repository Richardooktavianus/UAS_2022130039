<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'petugas_id',
    ];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}
