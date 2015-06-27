<?php

use Illuminate\Database\Seeder;

class ScoreTypeTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('score_type')->delete();
        
		\DB::table('score_type')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Best of Five',
				'name_short' => 'BO5',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
