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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->integer('id_parent')->default('0')->nullable();
            $table->string('type', 100)->nullable();
            $table->integer('active')->default('1');
            $table->string('classes', 100)->nullable();
            $table->json('data')->nullable();
            $table->string('header', 100)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('icon_color', 50)->nullable();
            $table->string('key', 100)->nullable();
            $table->string('label', 100)->nullable();
            $table->string('label_color', 100)->nullable();
            $table->string('route', 100)->nullable();
            $table->string('target', 100)->nullable();
            $table->string('text', 100)->nullable();
            $table->boolean('topnav')->nullable();
            $table->boolean('topnav_right')->nullable();
            $table->boolean('topnav_user')->nullable();
            $table->string('url')->nullable();
            $table->string('permision', 100)->nullable(); // Change 'string' to the appropriate data type
            $table->unique('permision');
            $table->json('available')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
};
