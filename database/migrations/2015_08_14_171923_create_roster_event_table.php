<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRosterEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roster_event', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('roster_id');
			$table->integer('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roster_event', function (Blueprint $table) {
            Schema::drop('roster_event');
        });
    }
}
