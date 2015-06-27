<?php

use Illuminate\Database\Seeder;

class GameTitleTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('game_title')->delete();
        
		\DB::table('game_title')->insert(array (
			0 => 
			array (
				'id' => 1,
				'title' => 'Advanced Warfare',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
