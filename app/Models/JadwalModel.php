<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalModel extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tanggal',
        'kuota'
    ];

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranModel::class, 'jadwal_id');
    }
}
