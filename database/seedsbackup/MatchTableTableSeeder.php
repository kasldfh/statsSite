<?php

use Illuminate\Database\Seeder;

class MatchTableTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('match_table')->delete();
        
		\DB::table('match_table')->insert(array (
			0 => 
			array (
				'id' => 1,
				'event_id' => 1,
				'roster_a_id' => 1,
				'roster_b_id' => 2,
				'a_map_count' => 3,
				'b_map_count' => 0,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'event_id' => 1,
				'roster_a_id' => 3,
				'roster_b_id' => 4,
				'a_map_count' => 1,
				'b_map_count' => 3,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			2 => 
			array (
				'id' => 3,
				'event_id' => 1,
				'roster_a_id' => 5,
				'roster_b_id' => 1,
				'a_map_count' => 2,
				'b_map_count' => 3,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			3 => 
			array (
				'id' => 4,
				'event_id' => 1,
				'roster_a_id' => 6,
				'roster_b_id' => 4,
				'a_map_count' => 3,
				'b_map_count' => 0,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'event_id' => 1,
				'roster_a_id' => 1,
				'roster_b_id' => 6,
				'a_map_count' => 3,
				'b_map_count' => 0,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			5 => 
			array (
				'id' => 6,
				'event_id' => 1,
				'roster_a_id' => 5,
				'roster_b_id' => 4,
				'a_map_count' => 3,
				'b_map_count' => 0,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			6 => 
			array (
				'id' => 7,
				'event_id' => 1,
				'roster_a_id' => 5,
				'roster_b_id' => 6,
				'a_map_count' => 3,
				'b_map_count' => 1,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 1,
			),
			7 => 
			array (
				'id' => 8,
				'event_id' => 1,
				'roster_a_id' => 1,
				'roster_b_id' => 5,
				'a_map_count' => 0,
				'b_map_count' => 3,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 2,
			),
			8 => 
			array (
				'id' => 9,
				'event_id' => 1,
				'roster_a_id' => 1,
				'roster_b_id' => 5,
				'a_map_count' => 3,
				'b_map_count' => 1,
				'match_type_id' => 1,
				'score_type_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'day' => 3,
			),
		));
	}

}
