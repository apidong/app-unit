<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';

    protected $casts = [
        'ukuran' => 'json',
        'created_at' => 'datetime:Y-m-d', 
    ];

    protected $fillable = [
        'nama',
        'sku',
        'deskripsi',
        'foto',
        'id_kategori',
        'harga',
        'berat',
        'ukuran',
    ];
    

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
