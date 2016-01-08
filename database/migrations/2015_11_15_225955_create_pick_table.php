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

            //if its not a ban then its gotta be a protect
            $table->boolean('is_ban');
            $table->integer('item_id');
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
