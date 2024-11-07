<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kamars')->insert([
            'id'=>1,
            'nomor_kamar'=>'A-01',
            'kategori_id'=>1,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>2,
            'nomor_kamar'=>'A-02',
            'kategori_id'=>1,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>3,
            'nomor_kamar'=>'A-03',
            'kategori_id'=>1,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>4,
            'nomor_kamar'=>'A-04',
            'kategori_id'=>1,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>5,
            'nomor_kamar'=>'A-05',
            'kategori_id'=>1,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>6,
            'nomor_kamar'=>'B-01',
            'kategori_id'=>2,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>7,
            'nomor_kamar'=>'B-02',
            'kategori_id'=>2,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>8,
            'nomor_kamar'=>'B-03',
            'kategori_id'=>2,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>9,
            'nomor_kamar'=>'B-04',
            'kategori_id'=>2,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>10,
            'nomor_kamar'=>'B-05',
            'kategori_id'=>2,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>11,
            'nomor_kamar'=>'C-01',
            'kategori_id'=>3,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>12,
            'nomor_kamar'=>'C-02',
            'kategori_id'=>3,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>13,
            'nomor_kamar'=>'C-03',
            'kategori_id'=>3,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>14,
            'nomor_kamar'=>'C-04',
            'kategori_id'=>3,
            'status'=>'tersedia',
        ]);
        DB::table('kamars')->insert([
            'id'=>15,
            'nomor_kamar'=>'C-05',
            'kategori_id'=>3,
            'status'=>'tersedia',
        ]);
    }
}

