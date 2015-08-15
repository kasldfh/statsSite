<?php

use Illuminate\Database\Seeder;

class UplinkTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('uplink')->delete();
        
		\DB::table('uplink')->insert(array (
			0 => 
			array (
				'id' => 1,
				'game_id' => 3,
				'team_a_score' => 11,
				'team_b_score' => 0,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'game_id' => 7,
				'team_a_score' => 11,
				'team_b_score' => 14,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 0,
			),
			2 => 
			array (
				'id' => 3,
				'game_id' => 10,
				'team_a_score' => 4,
				'team_b_score' => 17,
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
				'game_id' => 15,
				'team_a_score' => 12,
				'team_b_score' => 4,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'game_id' => 21,
				'team_a_score' => 20,
				'team_b_score' => 1,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 544,
				'a_victory' => 1,
			),
			5 => 
			array (
				'id' => 6,
				'game_id' => 25,
				'team_a_score' => 8,
				'team_b_score' => 6,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
			6 => 
			array (
				'id' => 7,
				'game_id' => 28,
				'team_a_score' => 4,
				'team_b_score' => 11,
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
				'game_id' => 32,
				'team_a_score' => 12,
				'team_b_score' => 8,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 592,
				'a_victory' => 1,
			),
		));
	}

}
