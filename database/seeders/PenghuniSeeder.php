<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenghuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penghunis')->insert([
            'id' => 1,
            'nama'=>'jono',
            'jenis_kelamin'=>'laki-laki',
            'alamat'=>'jln. Dago',
            'no_telepon'=>'08881232123',
            'status'=>'Karyawan',
        ]);
        DB::table('penghunis')->insert([
            'id' => 2,
            'nama'=>'budi',
            'jenis_kelamin'=>'laki-laki',
            'alamat'=>'jln. Sudirman',
            'no_telepon'=>'08881234567',
            'status'=>'Karyawan',
        ]);
        DB::table('penghunis')->insert([
            'id' => 3,
            'nama'=>'siti',
            'jenis_kelamin'=>'perempuan',
            'alamat'=>'jln. Pahlawan',
            'no_telepon'=>'08881237890',
            'status'=>'Mahasiswa',
        ]);
        DB::table('penghunis')->insert([
            'id' => 4,
            'nama'=>'andi',
            'jenis_kelamin'=>'laki-laki',
            'alamat'=>'jln. jakarta',
            'no_telepon'=>'08881233456',
            'status'=>'Mahasiswa',
        ]);
        DB::table('penghunis')->insert([
            'id' => 5,
            'nama'=>'rani',
            'jenis_kelamin'=>'perempuan',
            'alamat'=>'jln. Riau',
            'no_telepon'=>'08881236789',
            'status'=>'Karyawan',
        ]);
        DB::table('penghunis')->insert([
            'id' => 6,
            'nama'=>'yuni',
            'jenis_kelamin'=>'perempuan',
            'alamat'=>'jln. ambar',
            'no_telepon'=>'08881234543',
            'status'=>'Mahasiswa',
        ]);
    }
}

