<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRoundStatsFromMode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('snd', function (Blueprint $table) {
			$table->dropColumn('a_offense_wins');
			$table->dropColumn('b_offense_wins');
			$table->dropColumn('a_defense_wins');
			$table->dropColumn('b_defense_wins');
			$table->dropColumn('a_plant_a');
			$table->dropColumn('a_plant_b');
			$table->dropColumn('a_plant_a_win');
			$table->dropColumn('a_plant_b_win');
			$table->dropColumn('b_plant_a');
			$table->dropColumn('b_plant_b');
			$table->dropColumn('b_plant_a_win');
			$table->dropColumn('b_plant_b_win');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('snd', function (Blueprint $table) {
            //add columns back
			$table->integer('a_offense_wins')->nullable();
			$table->integer('b_offense_wins')->nullable();
			$table->integer('a_defense_wins')->nullable();
			$table->integer('b_defense_wins')->nullable();
			$table->integer('a_plant_a')->nullable();
			$table->integer('a_plant_b')->nullable();
			$table->integer('a_plant_a_win')->nullable();
			$table->integer('a_plant_b_win')->nullable();
			$table->integer('b_plant_a')->nullable();
			$table->integer('b_plant_b')->nullable();
			$table->integer('b_plant_a_win')->nullable();
			$table->integer('b_plant_b_win')->nullable();
        });
    }
}
