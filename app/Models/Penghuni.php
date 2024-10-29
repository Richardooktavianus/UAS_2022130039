<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'no_identitas', 'alamat', 'no_hp'];

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
