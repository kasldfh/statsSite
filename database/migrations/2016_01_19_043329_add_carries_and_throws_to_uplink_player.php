<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCarriesAndThrowsToUplinkPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uplink_player', function (Blueprint $table) {
            $table->integer('throws')->nullable();
            $table->integer('carries')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uplink_player', function (Blueprint $table) {
            $table->dropColumn(['throws', 'carries']);
        });
    }
}
