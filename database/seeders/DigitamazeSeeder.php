<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DigitamazeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Kelas
        DB::table('kelas')->insert([
            'nama' => 'Bio 1',
        ]);
        
        //gurus
        DB::table('gurus')->insert([
            'nama' => 'Hartanto',
            'mapel' => 'biologi',
            'kelamin' => 0,
            'nip' => 200132001,
        ]);

        //murids
        DB::table('murids')->insert([
            'nama' => 'Yanti',
            'kelamin' => 1,
            'nim' => 0520031,
        ]);

        //kelasmurid
        DB::table('kelas_murids')->insert([
            'id_kelas' => 1,
            'id_murid' => 1,
        ]);

        //kelasguru
        DB::table('kelas_gurus')->insert([
            'id_kelas' => 1,
            'id_guru' => 1,
        ]);
    }
}
