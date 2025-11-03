<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'tanggal_pendaftaran',
        'mahasiswa_id',
        'jadwal_id',
        'status_id',
        'keterangan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'mahasiswa_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalModel::class, 'jadwal_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusModel::class, 'status_id');
    }
}