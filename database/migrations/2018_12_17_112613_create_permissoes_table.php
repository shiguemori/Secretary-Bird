<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('label', 50);
            $table->string('controller', 100)->nullable();
            $table->string('rota', 100)->nullable();
            $table->integer('permissao_id')->nullable();
            $table->string('icone', 60)->nullable();
            $table->integer('visivel_menu')->default(0);
            $table->integer('visivel_user')->default(0);
            $table->integer('mobile')->default(0);
            $table->timestamps();
            $table->foreign('permissao_id', 'fk_permissao_id_1')->references('id')->on('permissoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissoes');
    }
}
