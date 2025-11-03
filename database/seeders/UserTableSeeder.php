<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsersModel;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        UsersModel::create([
            'username' => 'admin1',
            'password' => Hash::make('12345'),
            'roles_id' => 1 // admin
        ]);

        UsersModel::create([
            'username' => 'admin2',
            'password' => Hash::make('12345'),
            'roles_id' => 1 // admin
        ]);

        // Mahasiswa user
        for ($i = 1; $i <= 5; $i++) {
            UsersModel::create([
                'username' => 'mhs' . $i,
                'password' => Hash::make('12345'),
                'roles_id' => 2 // mahasiswa
            ]);
        }
    }
}