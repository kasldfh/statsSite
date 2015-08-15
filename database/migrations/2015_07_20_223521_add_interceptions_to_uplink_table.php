<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInterceptionsToUplinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uplink_player', function (Blueprint $table) {
            $table->integer('interceptions')->nullable();
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
            $table->dropColumn('interceptions');
        });
    }
}
