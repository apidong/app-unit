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
        $master = ['text' => 'Master', 'header' => 'Master', 'id_parent' => 0];
        $this->addNewMenu(2, $master, 'master', ['read']);

        $aplikasi = ['text' => 'Produk', 'url' => 'master/produk', 'id_parent' => 0, 'icon' => 'fas fa-shopping-bag'];
        $this->addNewMenu(3, $aplikasi, 'master-produk', ['read', 'create', 'update', 'delete']);

        $aplikasi = ['text' => 'Kategori Produk', 'url' => 'master/kategori', 'id_parent' => 0, 'icon' => 'fas fa-layer-group'];
        $this->addNewMenu(4, $aplikasi, 'master-kategori', ['read', 'create', 'update', 'delete']);

        $pengguna = ['text' => 'Alamat Saya', 'url' => 'master/alamat', 'id_parent' => 0, 'icon' => 'fas fa-address-card'];
        $this->addNewMenu(5, $pengguna, 'master-alamat', ['read', 'create', 'update', 'delete']);

        $peran = ['text' => 'Pelanggan', 'url' => 'master/pelanggan', 'id_parent' => 0, 'icon' => 'fas fa-address-book'];
        $this->addNewMenu(6, $peran, 'master-pelanggan', ['read', 'create', 'update', 'delete']);
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
