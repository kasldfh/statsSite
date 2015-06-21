<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHpPlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hp_player', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('hp_id')->nullable();
			$table->integer('player_id')->nullable();
			$table->integer('kills')->nullable();
			$table->integer('deaths')->nullable();
			$table->integer('defends')->nullable();
			$table->integer('captures')->nullable();
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
		Schema::drop('hp_player');
	}

}
