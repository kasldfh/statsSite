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
        Schema::table('roster_event', function (Blueprint $table) {
			$table->integer('id');
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
        Schema::table('roster_event', function (Blueprint $table) {
            Schema::drop('roster_event');
        });
    }
}
