<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hp', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('game_id');
			$table->integer('team_a_score');
			$table->integer('team_b_score');
			$table->boolean('team_a_host')->nullable();
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
		Schema::drop('hp');
	}

}
