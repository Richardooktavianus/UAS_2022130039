<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'jobdesk',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
