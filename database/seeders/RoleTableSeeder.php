<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolesModel; // Make sure this import is correct

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        RolesModel::create([
            'role_kode' => 'ADM',
            'role_nama' => 'admin'
        ]);
        RolesModel::create([
            'role_kode' => 'MHS',
            'role_nama' => 'mahasiswa'
        ]);
    }
}