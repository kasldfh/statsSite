<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSndPlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snd_player', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('snd_id');
			$table->integer('player_id');
			$table->integer('kills')->nullable();
			$table->integer('deaths')->nullable();
			$table->integer('plants')->nullable();
			$table->integer('defuse')->nullable();
			$table->integer('first_bloods')->nullable();
			$table->integer('first_blood_wins')->nullable();
			$table->integer('last_man_standing')->nullable();
			$table->integer('last_man_standing_wins')->nullable();
			$table->boolean('host')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('snd_player');
	}

}
