<?php

use App\Traits\MenuTrait;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    use MenuTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pengaturan = ['text' => 'Pengaturan', 'header' => 'Pengaturan', 'url' => 'home', 'id_parent' => 0];
        $this->addNewMenu(20, $pengaturan, 'pengaturan', ['read']);

        $aplikasi = ['text' => 'Aplikasi', 'url' => 'pengaturan/aplikasi', 'id_parent' => 0, 'icon' => 'fas fa-wrench'];
        $this->addNewMenu(21, $aplikasi, 'pengaturan-aplikasi', ['read', 'update']);

        $alamat = ['text' => 'Alamat', 'url' => 'pengaturan/alamat', 'id_parent' => 0, 'icon' => 'fas fa-map'];
        $this->addNewMenu(22, $alamat, 'pengaturan-alamat', ['read', 'update']);

        $pengguna = ['text' => 'Pengguna', 'url' => 'pengaturan/pengguna', 'id_parent' => 0, 'icon' => 'fas fa-users'];
        $this->addNewMenu(23, $pengguna, 'pengaturan-pengguna', ['read', 'create', 'update', 'delete']);

        $peran = ['text' => 'Peran', 'url' => 'pengaturan/peran', 'id_parent' => 0, 'icon' => 'fas fa-user-tag'];
        $this->addNewMenu(24, $peran, 'pengaturan-peran', ['read', 'create', 'update', 'delete']);
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
