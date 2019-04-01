<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministradoresPermissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administradores_permissoes', function (Blueprint $table) {
            $table->integer('administrador_id');
            $table->integer('permissao_id');
            $table->timestamps();
            $table->foreign('administrador_id')->references('id')->on('administradores')->onDelete('CASCADE');
            $table->foreign('permissao_id')->references('id')->on('permissoes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administradores_permissoes');
    }
}
