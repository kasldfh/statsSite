<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameTitleIdToMapMode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('map_mode', function (Blueprint $table) {
            $table->bigInteger('game_title_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('map_mode', function (Blueprint $table) {
            $table->dropColumn('game_title_id');
        });
    }
}
