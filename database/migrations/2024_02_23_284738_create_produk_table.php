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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('sku', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto', 120)->nullable();
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->decimal('harga', 20, 2);
            $table->decimal('berat', 20, 0);
            $table->json('ukuran');
            $table->timestamps();
            $table->softDeletes();

            // index
            $table->index('nama');
            $table->index('sku'); // Assuming 'sku' is the column you want to index
            $table->index('id_kategori');

            // Foreign key constraint
            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
};
