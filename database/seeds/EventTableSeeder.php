<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('event')->delete();
        
		\DB::table('event')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Brazil',
				'event_type_id' => 1,
				'game_title_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
