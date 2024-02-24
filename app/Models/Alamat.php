<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';

    protected $fillable = [
        'nama',
        'nama_prov',
        'nama_kab',
        'nama_kec',
        'nama_desa',
        'kode_desa',
        'kode_pos',
        'alamat',
        'lainnya',
        'region',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'region' => 'json'
    ];
}
