<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JurusanModel;

class JurusanTableSeeder extends Seeder
{
    public function run()
    {
        JurusanModel::create([
            'jurusan_kode' => 'TI',
            'jurusan_nama' => 'Jurusan Teknologi Informasi',
            'kampus_id'    => 1 // Utama
        ]);
    }
}