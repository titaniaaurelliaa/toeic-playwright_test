<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'users_id',
        'mahasiswa_nim',
        'mahasiswa_nama',
        'alamat',
        'no_telp',
        'email',
        'nik',
        'file_ktm',
        'file_ktp',
        'file_pas_foto',
        'prodi_id',
        'jurusan_id',
        'kampus_id',
        'foto_profil',
    ];

    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'users_id');
    }

    public function prodi()
    {
        return $this->belongsTo(ProdiModel::class, 'prodi_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(JurusanModel::class, 'jurusan_id');
    }

    public function kampus()
    {
        return $this->belongsTo(KampusModel::class, 'kampus_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranModel::class, 'mahasiswa_id');
    }
}
