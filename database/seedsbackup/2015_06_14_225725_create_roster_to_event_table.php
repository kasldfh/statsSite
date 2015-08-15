<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRosterToEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roster_to_event', function(Blueprint $table)
		{
			$table->integer('id');
			$table->integer('roster_id');
			$table->integer('event_id');
			$table->integer('team_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roster_to_event');
	}

}
