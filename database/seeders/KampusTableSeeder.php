<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KampusModel;

class KampusTableSeeder extends Seeder
{
    public function run()
    {
        KampusModel::create([
            'kampus_nama'   => 'Utama',
            'kampus_alamat' => 'Malang'
        ]);
        KampusModel::create([
            'kampus_nama' => 'PSDKU Kediri',
            'kampus_alamat' => 'Kediri'
        ]);
        KampusModel::create([
            'kampus_nama' => 'PSDKU Lumajang',
            'kampus_alamat' => 'Lumajang'
        ]);
        KampusModel::create([
            'kampus_nama' => 'PSDKU Pamekasan',
            'kampus_alamat' => 'Pamekasan'
        ]);
    }
}