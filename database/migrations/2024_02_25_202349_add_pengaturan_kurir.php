<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
                'judul' => 'Pilihan Kurir',
                'key' => 'couriers',
                'value' => 'jne,sicepat,jnt,anteraja',
                'keterangan' => 'Pilihan Kurir yang aktif',
                'jenis' => 'multiselect',
                'kategori' => 'kurir',
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
