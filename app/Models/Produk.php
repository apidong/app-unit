<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $casts = [
        'ukuran' => 'json',
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
