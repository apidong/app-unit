<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAplikasi extends Model
{
    use HasFactory;

    protected $table = 'setting_aplikasi';

    protected $fillable = [
        'judul',
        'key',
        'value',
        'keterangan',
        'jenis',
        'option',
        'attribute',
        'kategori',
    ];

     // Relationship to itself
     public function scopeUtama(Builder $query) :Builder
     {
        return  $query->where('kategori', 'umum');
     }

     // Relationship to itself
     public function scopeAlamat(Builder $query) :Builder
     {
        return  $query->where('kategori', 'alamat');
     }
}
