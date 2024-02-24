<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'nomor_telepon',
        'nama_prov',
        'nama_kab',
        'nama_kec',
        'kode_kec',
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
