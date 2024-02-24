<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

        Schema::create('alamat', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nama_prov', 100);
            $table->string('nama_kab', 100);
            $table->string('nama_kec', 100);
            $table->string('kode_kec', 50);
            $table->string('kode_pos', 50);
            $table->text('alamat');
            $table->text('lainnya')->nullable();
            $table->json('region')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // index
            $table->index('nama');
            $table->index('nama_prov');
            $table->index('nama_kab');
            $table->index('nama_kec');
            $table->index('kode_kec');
            $table->index('kode_pos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alamat');
    }
};
