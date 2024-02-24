<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
    ];

    function produk() {
        
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d', 
    ];
}