<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'status',
    ];

    public function sewa()
    {
        return $this->hasMany(Sewa::class);
    }
}
