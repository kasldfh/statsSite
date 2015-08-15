<?php

use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('game')->delete();
        
		\DB::table('game')->insert(array (
			0 => 
			array (
				'id' => 1,
				'match_id' => 1,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 1,
				'score_type_id' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'match_id' => 1,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 3,
				'score_type_id' => 1,
			),
			2 => 
			array (
				'id' => 3,
				'match_id' => 1,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 6,
				'score_type_id' => 1,
			),
			3 => 
			array (
				'id' => 4,
				'match_id' => 2,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 8,
				'score_type_id' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'match_id' => 2,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 11,
				'score_type_id' => 1,
			),
			5 => 
			array (
				'id' => 6,
				'match_id' => 2,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 5,
				'score_type_id' => 1,
			),
			6 => 
			array (
				'id' => 7,
				'match_id' => 2,
				'game_number' => 4,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 13,
				'score_type_id' => 1,
			),
			7 => 
			array (
				'id' => 8,
				'match_id' => 3,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 1,
				'score_type_id' => 1,
			),
			8 => 
			array (
				'id' => 9,
				'match_id' => 3,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 3,
				'score_type_id' => 1,
			),
			9 => 
			array (
				'id' => 10,
				'match_id' => 3,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 6,
				'score_type_id' => 1,
			),
			10 => 
			array (
				'id' => 11,
				'match_id' => 3,
				'game_number' => 4,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 14,
				'score_type_id' => 1,
			),
			11 => 
			array (
				'id' => 12,
				'match_id' => 3,
				'game_number' => 5,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 10,
				'score_type_id' => 1,
			),
			12 => 
			array (
				'id' => 13,
				'match_id' => 4,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 1,
				'score_type_id' => 1,
			),
			13 => 
			array (
				'id' => 14,
				'match_id' => 4,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 3,
				'score_type_id' => 1,
			),
			14 => 
			array (
				'id' => 15,
				'match_id' => 4,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 6,
				'score_type_id' => 1,
			),
			15 => 
			array (
				'id' => 16,
				'match_id' => 5,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 4,
				'score_type_id' => 1,
			),
			16 => 
			array (
				'id' => 17,
				'match_id' => 5,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 7,
				'score_type_id' => 1,
			),
			17 => 
			array (
				'id' => 18,
				'match_id' => 5,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 2,
				'score_type_id' => 3,
			),
			18 => 
			array (
				'id' => 19,
				'match_id' => 6,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 15,
				'score_type_id' => 1,
			),
			19 => 
			array (
				'id' => 20,
				'match_id' => 6,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 10,
				'score_type_id' => 1,
			),
			20 => 
			array (
				'id' => 21,
				'match_id' => 6,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 13,
				'score_type_id' => 1,
			),
			21 => 
			array (
				'id' => 22,
				'match_id' => 7,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 4,
				'score_type_id' => 1,
			),
			22 => 
			array (
				'id' => 23,
				'match_id' => 7,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 7,
				'score_type_id' => 1,
			),
			23 => 
			array (
				'id' => 24,
				'match_id' => 7,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 2,
				'score_type_id' => 1,
			),
			24 => 
			array (
				'id' => 25,
				'match_id' => 7,
				'game_number' => 4,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 9,
				'score_type_id' => 1,
			),
			25 => 
			array (
				'id' => 26,
				'match_id' => 8,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 15,
				'score_type_id' => 1,
			),
			26 => 
			array (
				'id' => 27,
				'match_id' => 8,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 3,
				'score_type_id' => 1,
			),
			27 => 
			array (
				'id' => 28,
				'match_id' => 8,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 13,
				'score_type_id' => 1,
			),
			28 => 
			array (
				'id' => 29,
				'match_id' => 9,
				'game_number' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 4,
				'score_type_id' => 1,
			),
			29 => 
			array (
				'id' => 30,
				'match_id' => 9,
				'game_number' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 11,
				'score_type_id' => 1,
			),
			30 => 
			array (
				'id' => 31,
				'match_id' => 9,
				'game_number' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 2,
				'score_type_id' => 1,
			),
			31 => 
			array (
				'id' => 32,
				'match_id' => 9,
				'game_number' => 4,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'map_mode_id' => 9,
				'score_type_id' => 1,
			),
		));
	}

}
