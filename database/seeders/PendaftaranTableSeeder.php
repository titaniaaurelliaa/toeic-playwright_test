<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PendaftaranModel;

class PendaftaranTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            PendaftaranModel::create([
                'mahasiswa_id'        => $i,
                'tanggal_pendaftaran' => now(),
                'jadwal_id'           => $i % 2 + 1,
                'status_id'           => $i % 3 + 1 // Alternating between Pending, Diterima, Ditolak
            ]);
        }
    }
}