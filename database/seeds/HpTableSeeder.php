<?php

use Illuminate\Database\Seeder;

class HpTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('hp')->delete();
        
		\DB::table('hp')->insert(array (
			0 => 
			array (
				'id' => 1,
				'game_id' => 1,
				'team_a_score' => 250,
				'team_b_score' => 66,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 438,
				'a_victory' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'game_id' => 4,
				'team_a_score' => 230,
				'team_b_score' => 174,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
			2 => 
			array (
				'id' => 3,
				'game_id' => 8,
				'team_a_score' => 170,
				'team_b_score' => 202,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 0,
			),
			3 => 
			array (
				'id' => 4,
				'game_id' => 13,
				'team_a_score' => 250,
				'team_b_score' => 106,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 566,
				'a_victory' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'game_id' => 16,
				'team_a_score' => 237,
				'team_b_score' => 187,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
			5 => 
			array (
				'id' => 6,
				'game_id' => 19,
				'team_a_score' => 250,
				'team_b_score' => 87,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 561,
				'a_victory' => 1,
			),
			6 => 
			array (
				'id' => 7,
				'game_id' => 22,
				'team_a_score' => 187,
				'team_b_score' => 210,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 0,
			),
			7 => 
			array (
				'id' => 8,
				'game_id' => 26,
				'team_a_score' => 174,
				'team_b_score' => 206,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 0,
			),
			8 => 
			array (
				'id' => 9,
				'game_id' => 29,
				'team_a_score' => 250,
				'team_b_score' => 94,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 486,
				'a_victory' => 1,
			),
		));
	}

}
