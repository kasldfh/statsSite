<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCtfPlayerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ctf_player', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('ctf_id')->nullable();
			$table->integer('player_id')->nullable();
			$table->integer('defends')->nullable();
			$table->integer('captures')->nullable();
			$table->integer('returns')->nullable();
			$table->boolean('host')->nullable();
			$table->integer('kills')->nullable();
			$table->integer('deaths')->nullable();
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
		Schema::drop('ctf_player');
	}

}
