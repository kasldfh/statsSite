<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUplinkPlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uplink_player', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('uplink_id')->nullable();
			$table->integer('player_id')->nullable();
			$table->integer('kills')->nullable();
			$table->integer('deaths')->nullable();
			$table->integer('uplinks')->nullable();
			$table->integer('makes')->nullable();
			$table->integer('misses')->nullable();
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
		Schema::drop('uplink_player');
	}

}
