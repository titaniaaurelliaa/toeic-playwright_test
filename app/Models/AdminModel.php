<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admin';

    protected $primaryKey = 'id';

    protected $fillable = [
        'users_id',
        'admin_nip',
        'admin_nama',
        'email',
        'no_telp',
        'alamat',
        'username',
        'foto_profil',
    ];

    public function user()
    {
        return $this->belongsTo(UsersModel::class, 'users_id');
    }
}
