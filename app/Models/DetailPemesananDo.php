<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesananDo extends Model
{
    use HasFactory;


    protected $table = 'detail_pemesanan_do';

    protected $fillable = [
        'id_pemesanan_do',
        'id_produk',
        'sku',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'berat_produk',
        'ukuran',
        'jumlah',
    ];

    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'ukuran' => 'json'
    ];

    function produk()  {
        return  $this->hasOne(Produk::class, 'id', 'id_produk');
    }
}
