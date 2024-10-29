<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kamar', 'tipe_kamar_id', 'deskripsi', 'status'];

    public function tipeKamar()
    {
        return $this->belongsTo(TipeKamar::class);
    }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
