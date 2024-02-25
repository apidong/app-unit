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
            $table->string('nama_pengirim', 100)->notNullable();
            $table->json('koordinat_pengirim')->notNullable();
            $table->string('kode_pos_pengirim', 50)->notNullable();
            $table->string('nama_penerima', 100)->notNullable();
            $table->text('alamat_penerima')->notNullable();
            $table->string('kode_pos_penerima', 50)->notNullable();
            $table->json('koordinat_penerima')->notNullable();
            $table->decimal('harga_total')->notNullable();
            $table->decimal('ongkos_kirim')->notNullable();
            $table->string('ekspedisi', 100)->notNullable();
            $table->string('tipe', 20)->notNullable();
            $table->enum('status', ['draft', 'siap', 'menunggu', 'tolak', 'revisi', 'setuju'])->notNullable();
            $table->enum('kirim', ['pending', 'dikirim', 'selesai'])->notNullable(); // Add actual values for 'kirim'
            $table->unsignedBigInteger('id_pembuat')->notNullable();
            $table->unsignedBigInteger('id_pelanggan')->notNullable();
            $table->unsignedBigInteger('id_alamat')->notNullable();
            $table->text('keterangan')->notNullable();
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
