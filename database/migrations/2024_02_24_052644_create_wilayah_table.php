<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
        Schema::create('wilayah', function (Blueprint $table) {
            $table->string('kode_prov', 50);
            $table->string('nama_prov', 100);
            $table->string('kode_kab', 50);
            $table->string('nama_kab', 100);
            $table->string('kode_kec', 50);
            $table->string('nama_kec', 100);
            $table->string('kode_desa', 50);
            $table->string('nama_desa', 100);
            $table->timestamps(); // Optional, includes created_at and updated_at columns
        });

        

        // Read the contents of your SQL file
        $sqlFile = File::get(database_path('kode_wilayah.sql'));

        // Execute the queries
        DB::unprepared($sqlFile);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah');
    }
};
