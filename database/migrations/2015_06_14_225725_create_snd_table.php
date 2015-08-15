<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSndTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snd', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('game_id');
			$table->integer('team_a_score');
			$table->integer('team_b_score');
			$table->integer('a_offense_wins')->nullable();
			$table->integer('b_offense_wins')->nullable();
			$table->integer('a_defense_wins')->nullable();
			$table->integer('b_defense_wins')->nullable();
			$table->integer('a_plant_a')->nullable();
			$table->integer('a_plant_b')->nullable();
			$table->integer('a_plant_a_win')->nullable();
			$table->integer('a_plant_b_win')->nullable();
			$table->integer('b_plant_a')->nullable();
			$table->integer('b_plant_b')->nullable();
			$table->integer('b_plant_a_win')->nullable();
			$table->integer('b_plant_b_win')->nullable();
			$table->boolean('team_a_host');
			$table->boolean('team_b_host');
			$table->timestamps();
			$table->integer('game_time');
			$table->boolean('a_victory');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('snd');
	}

}
