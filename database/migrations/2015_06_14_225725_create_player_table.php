<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('player', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('alias', 50);
			$table->string('role', 100);
			$table->date('DOB')->nullable();
			$table->integer('age');
			$table->string('first_event', 100);
			$table->timestamps();
			$table->string('hometown', 150)->nullable();
			$table->string('country', 10)->nullable();
			$table->string('photo_url', 150)->nullable();
			$table->bigInteger('twitter_widget')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('player');
	}

}
