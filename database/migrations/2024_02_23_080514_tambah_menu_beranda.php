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
        $atribute = ['text' => 'Beranda', 'url' => 'home', 'id_parent' => 0, 'icon' => 'fas fa-tachometer-alt'];
        $this->addNewMenu(1, $atribute, 'beranda', ['read']);
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
