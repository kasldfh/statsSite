<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSndPlayerDefuse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('snd_player', function (Blueprint $table) {
            $table->renameColumn('defuse', 'defuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('snd_player', function (Blueprint $table) {
            $table->renameColumn('defuses', 'defuse');
        });
    }
}
