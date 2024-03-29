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
        Schema::create('detail_pemesanan_do', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesanan_do');
            $table->unsignedBigInteger('id_produk');
            $table->string('nama_produk', 150);
            $table->string('sku', 100)->nullable();
            $table->text('deskripsi_produk')->nullable();
            $table->decimal('harga_produk', 20, 0);
            $table->decimal('berat_produk', 20, 0);
            $table->text('ukuran')->nullable();
            $table->decimal('jumlah', 20, 0);
            $table->timestamps();

            $table->index('id_produk');
            $table->index('id_pemesanan_do');
            $table->index('nama_produk');

            $table->foreign('id_pemesanan_do')->references('id')->on('pemesanan_do');
            $table->foreign('id_produk')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemesanan_dos');
    }
};
