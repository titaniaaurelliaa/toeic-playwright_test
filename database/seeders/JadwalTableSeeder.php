<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalModel;
use Carbon\Carbon;

class JadwalTableSeeder extends Seeder
{
    public function run()
    {
        JadwalModel::create([
            'tanggal' => Carbon::now()->addDays(7),
            'kuota' => '50'
        ]);

        JadwalModel::create([
            'tanggal' => Carbon::now()->addDays(14),
            'kuota' => '50'
        ]);
    }
}