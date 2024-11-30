<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            'id' => 1,
            'nama_kategori' => 'Bronze',
            'ukuran_kamar' => '3x3',
            'harga_per_bulan' => 500000,
            'fasilitas_id' => 1,
            'deskripsi' => 'Tidak ada Kasur dan Lemari',
            'photo' => 'bronze.jpeg',
        ]);
        DB::table('kategoris')->insert([
            'id' => 2,
            'nama_kategori' => 'Silver',
            'ukuran_kamar' => '4x5',
            'harga_per_bulan' => 700000,
            'fasilitas_id' => 2,
            'deskripsi' => 'Tempat Tidur dan Meja Belajar',
            'photo' => 'silver.jpeg',
        ]);
        DB::table('kategoris')->insert([
            'id' => 3,
            'nama_kategori' => 'Gold',
            'ukuran_kamar' => '5x6',
            'harga_per_bulan' => 1000000,
            'fasilitas_id' => 3,
            'deskripsi' => 'Tempat Tidur, Lemari, Meja Belajar dan AC',
            'photo' => 'Gold.jpeg',
        ]);
    }
}

