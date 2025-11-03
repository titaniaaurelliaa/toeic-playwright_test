<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KampusModel extends Model
{
    use HasFactory;

    protected $table = 'kampus';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'kampus_nama',
        'kampus_alamat'
    ];
}
