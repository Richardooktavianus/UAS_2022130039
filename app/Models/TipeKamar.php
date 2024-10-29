<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    protected $fillable = ['nama_tipe', 'harga_per_bulan'];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }
}
