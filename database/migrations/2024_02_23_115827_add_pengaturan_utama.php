<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                'judul' => 'Deskripsi Aplikasi',
                'key' => 'deskripsi_aplikasi',
                'value' => 'Unit APP',
                'keterangan' => 'Deskripsi Singkat Aplikasi',
                'jenis' => 'text',
                'kategori' => 'Umum',
            ],
            [
                'judul' => 'API Url Biteship',
                'key' => 'url_biteship',
                'value' => 'https://api.biteship.com',
                'keterangan' => 'Url API Bitship',
                'jenis' => 'text',
                'kategori' => 'Umum',
            ],
            [
                'judul' => 'Token Biteship',
                'key' => 'token_biteship',
                'value' => null,
                'keterangan' => 'Kunci API dari  Biteship',
                'jenis' => 'textarea',
                'kategori' => 'Umum',
            ],
        ];

        DB::table('setting_aplikasi')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
