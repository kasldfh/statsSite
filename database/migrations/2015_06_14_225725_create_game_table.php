<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('game', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('match_id');
			$table->integer('game_number');
			$table->timestamps();
			$table->integer('map_mode_id');
			$table->integer('score_type_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('game');
	}

}
