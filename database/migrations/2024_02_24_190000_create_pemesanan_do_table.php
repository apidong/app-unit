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
        Schema::create('pemesanan_do', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_do', 50)->notNullable();
            $table->string('nama_pengirim', 100)->nullable();
            $table->json('koordinat_pengirim')->nullable();
            $table->string('kode_pos_pengirim', 50)->nullable();
            $table->string('nama_penerima', 100)->nullable();
            $table->text('alamat_penerima')->nullable();
            $table->string('kode_pos_penerima', 50)->nullable();
            $table->json('koordinat_penerima')->nullable();
            $table->decimal('harga_total')->nullable();
            $table->decimal('ongkos_kirim')->nullable();
            $table->string('ekspedisi', 100)->nullable();
            $table->string('tipe', 70)->nullable();
            $table->enum('status', ['draft', 'siap', 'menunggu', 'tolak', 'revisi', 'setuju'])->nullable();
            $table->enum('kirim', ['pending', 'dikirim', 'selesai'])->nullable(); // Add actual nullable()'kirim'
            $table->unsignedBigInteger('id_pembuat')->nullable();
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->unsignedBigInteger('id_alamat')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggan');
            $table->foreign('id_pembuat')->references('id')->on('users');
            $table->foreign('id_alamat')->references('id')->on('alamat');

            // Indexes
            $table->index('nomor_do');
            $table->index('nama_penerima');
            $table->index('status');
            $table->index('kirim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_do');
    }
};
