<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusModel;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            [
                'status_kode' => 'ST001',
                'status_nama' => 'Diproses'
            ],
            [
                'status_kode' => 'ST002',
                'status_nama' => 'Diterima'
            ],
            [
                'status_kode' => 'ST003',
                'status_nama' => 'Ditolak'
            ],
            [
                'status_kode' => 'ST004',
                'status_nama' => 'Menunggu pembayaran'
            ]
        ];

        foreach ($statuses as $status) {
            StatusModel::firstOrCreate(
                ['status_kode' => $status['status_kode']],
                $status
            );
        }
    }
}