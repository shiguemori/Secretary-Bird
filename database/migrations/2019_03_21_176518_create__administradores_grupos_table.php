<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministradoresGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores_grupos', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('administrador_id');
            $table->integer('grupo_id');
            $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('CASCADE');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administradores_grupos');
    }
}
