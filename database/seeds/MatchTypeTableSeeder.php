<?php

use Illuminate\Database\Seeder;

class MatchTypeTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('match_type')->delete();
        
		\DB::table('match_type')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Pool Play',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
