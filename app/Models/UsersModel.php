<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsersModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password', 'roles_id'];

    public function roles()
    {
        return $this->belongsTo(RolesModel::class, 'roles_id');
    }

    public function admin()
    {
        return $this->hasOne(AdminModel::class, 'users_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(MahasiswaModel::class, 'users_id');
    }
}
