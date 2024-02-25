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
        $penjualan = ['text' => 'Penjualan', 'header' => 'Penjualan', 'id_parent' => 0];
        $this->addNewMenu(11, $penjualan, 'penjualan', ['read']);

        $do = ['text' => 'Delivery Order', 'url' => 'penjualan/do', 'id_parent' => 0, 'icon' => 'fas fa-truck-loading'];
        $this->addNewMenu(12, $do, 'penjualan-do', ['read', 'create', 'update', 'delete']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
