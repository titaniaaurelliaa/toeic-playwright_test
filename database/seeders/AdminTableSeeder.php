<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminModel;

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        AdminModel::create([
            'users_id'  => "1",
            'admin_nip' => 'ADM001',
            'admin_nama'=> 'Admin Utama',
            'email'     => 'admin1@example.com',
            'no_telp'   => '0854321',
            'alamat'    => 'Jalan Remujung Malang',
            'username'  => 'admin1'
        ]);

        AdminModel::create([
            'users_id'  => "2",
            'admin_nip' => 'ADM002',
            'admin_nama'=> 'Admin Kedua',
            'email'     => 'admin2@example.com',
            'no_telp'   => '0854322',
            'alamat'    => 'Jalan Piskip Malang',
            'username'  => 'admin2'
        ]);
    }
}