<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerRosterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player_roster', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('roster_id');
			$table->integer('player_id');
			$table->timestamps();
			$table->boolean('starter');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('player_roster');
	}

}
