<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fasilitas')->insert([
            'id' => 1,
            'nama_fasilitas' => 'Basic',
            'deskripsi' => 'Wifi, kamar mandi dalam',
            'petugas_id' => 1,
            'harga' => 200000,
        ]);

        DB::table('fasilitas')->insert([
            'id' => 2,
            'nama_fasilitas' => 'Advanced 1',
            'deskripsi' => 'Wifi, kamar mandi dalam, Laundry',
            'petugas_id' => 2,
            'harga' => 500000,
        ]);

        DB::table('fasilitas')->insert([
            'id' => 3,
            'nama_fasilitas' => 'Advanced 2',
            'deskripsi' => 'Wifi, kamar mandi dalam, Catering',
            'petugas_id' => 3,
            'harga' => 600000,
        ]);

        DB::table('fasilitas')->insert([
            'id' => 4,
            'nama_fasilitas' => 'Premium',
            'deskripsi' => 'Wifi, kamar mandi dalam, Laundry, Catering',
            'petugas_id' => 4,
            'harga' => 400000,
        ]);
    }
}
