<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdiModel;

class ProdiTableSeeder extends Seeder
{
    public function run()
    {
        ProdiModel::create([
            'prodi_kode'    => 'SI',
            'prodi_nama'    => 'Sistem Informasi',
            'jurusan_id'    => 1
        ]);

        ProdiModel::create([
            'prodi_kode'    => 'TI',
            'prodi_nama'    => 'Teknik Informatika',
            'jurusan_id'    => 1
        ]);
    }
}