<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('game_id');
            $table->integer('player_id');

            //first, second, third, etc
            $table->integer('number');
            $table->integer('item_id');

            //if its not a ban then its gotta be a protect
            /* for pick types, we expect
                0 for no selection
                1 for a protect
                2 for a ban
                3 for a missed choice
                4 for no choice
             */
            $table->integer('pick_type');
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
        Schema::drop('pick');
    }
}
