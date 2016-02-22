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

            //note: this is different from match score_type_io
            //id 0 = normal map, got player records and scores
            //id 1 = got scores, no player records
            //id 2 = got victors, scores aren't accurate
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
