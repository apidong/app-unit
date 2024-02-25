<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemesananDo extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_do';

    protected $fillable = [
        'nomor_do',
        'nama_pengirim',
        'koordinat_pengirim',
        'kode_pos_pengirim',
        'nama_penerima',
        'alamat_penerima',
        'kode_pos_penerima',
        'koordinat_penerima',
        'harga_total',
        'ongkos_kirim',
        'ekspedisi',
        'tipe',
        'status',
        'kirim',
        'id_pembuat',
        'id_pelanggan',
        'id_alamat',
        'keterangan',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'koordinat_pengirim' => 'json',
        'koordinat_penerima' => 'json'
    ];

    function scopeIdPembuat(Builder $query): Builder
    {
        return $query->where('id_pembuat', auth()->id);
    }

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    // protected function firstName(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => ucfirst($value),
    //     );
    // }
}
