<?php

use Illuminate\Database\Seeder;

class RosterToEventTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('roster_to_event')->delete();
        
		\DB::table('roster_to_event')->insert(array (
			0 => 
			array (
				'id' => 1,
				'roster_id' => 1,
				'event_id' => 1,
				'team_id' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'roster_id' => 2,
				'event_id' => 1,
				'team_id' => 2,
			),
			2 => 
			array (
				'id' => 3,
				'roster_id' => 3,
				'event_id' => 1,
				'team_id' => 3,
			),
			3 => 
			array (
				'id' => 4,
				'roster_id' => 4,
				'event_id' => 1,
				'team_id' => 4,
			),
			4 => 
			array (
				'id' => 5,
				'roster_id' => 5,
				'event_id' => 1,
				'team_id' => 5,
			),
			5 => 
			array (
				'id' => 6,
				'roster_id' => 6,
				'event_id' => 1,
				'team_id' => 6,
			),
		));
	}

}
