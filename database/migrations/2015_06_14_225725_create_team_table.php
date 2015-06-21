<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('team', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100);
			$table->string('owner1', 100)->nullable();
			$table->string('owner2', 100)->nullable();
			$table->string('twitter', 150)->nullable();
			$table->string('youtube', 150)->nullable();
			$table->string('twitch', 150)->nullable();
			$table->string('mlg_tv', 150)->nullable();
			$table->string('web_url', 150)->nullable();
			$table->string('team_color', 10);
			$table->string('logo_url', 100)->nullable();
			$table->string('team_url', 100);
			$table->timestamps();
			$table->string('flair', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('team');
	}

}
