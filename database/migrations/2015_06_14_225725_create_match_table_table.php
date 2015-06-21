<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('match_table', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id');
			$table->integer('roster_a_id');
			$table->integer('roster_b_id');
			$table->integer('a_map_count')->nullable();
			$table->integer('b_map_count')->nullable();
			$table->integer('match_type_id');
			$table->integer('score_type_id');
			$table->timestamps();
			$table->integer('day');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('match_table');
	}

}
