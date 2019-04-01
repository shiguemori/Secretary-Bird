<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 50);
			$table->string('sobrenome', 170);
			$table->string('email', 200)->unique();
			$table->string('password', 255);
            $table->integer('status_id');
            $table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('status_id', 'fk_status_id_1')->references('id')->on('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('usuarios');
	}

}
