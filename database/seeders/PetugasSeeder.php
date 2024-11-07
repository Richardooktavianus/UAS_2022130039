<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('petugas')->insert([
            'id' => 1,
            'nama_petugas'=>'jono',
            'email'=>'jono@jono.com',
            'no_telepon'=>'08881232123',
        ]);

        DB::table('petugas')->insert([
            'id' => 2,
            'nama_petugas'=>'budi',
            'email'=>'budi@budi.com',
            'no_telepon'=>'08881234567',
        ]);

        DB::table('petugas')->insert([
            'id' => 3,
            'nama_petugas'=>'siti',
            'email'=>'siti@siti.com',
            'no_telepon'=>'08881237890',
        ]);

        DB::table('petugas')->insert([
            'id' => 4,
            'nama_petugas'=>'andi',
            'email'=>'andi@andi.com',
            'no_telepon'=>'08881233456',
        ]);

        DB::table('petugas')->insert([
            'id' => 5,
            'nama_petugas'=>'rani',
            'email'=>'rani@rani.com',
            'no_telepon'=>'08881236789',
        ]);

        DB::table('petugas')->insert([
            'id' => 6,
            'nama_petugas'=>'yuni',
            'email'=>'yuni@yuni.com',
            'no_telepon'=>'08881234543',
        ]);
    }
}

