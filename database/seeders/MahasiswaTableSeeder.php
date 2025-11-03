<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MahasiswaModel;
use Faker\Factory as Faker;

class MahasiswaTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            MahasiswaModel::create([
                'users_id'      => 2 + $i,
                'mahasiswa_nim' => '202208100' . $i,
                'mahasiswa_nama'=> $faker->name,
                'alamat'        => $faker->address,
                'no_telp'       => '034123' . $i,
                'email'         => $faker->unique()->safeEmail,
                'file_ktm'      => 'ktm_mhs_' . 2+$i . '.jpg',
                'file_ktp'      => 'ktp_mhs_' . 2+$i . '.jpg',
                'file_pas_foto' => 'foto_mhs_' . 2+$i . '.jpg',
                'prodi_id'      => $i % 2 + 1 // Alternating between Sistem Informasi and Teknik Informatika
            ]);
        }
    }
}