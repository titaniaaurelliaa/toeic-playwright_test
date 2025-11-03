<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleTableSeeder::class,
            UserTableSeeder::class,
            KampusTableSeeder::class,
            JurusanTableSeeder::class,
            ProdiTableSeeder::class,
            StatusTableSeeder::class,
            JadwalTableSeeder::class,
            MahasiswaTableSeeder::class,
            AdminTableSeeder::class,
            PendaftaranTableSeeder::class,
        ]);
    }
}
