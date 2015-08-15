<?php

use Illuminate\Database\Seeder;

class CtfTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('ctf')->delete();
        
		\DB::table('ctf')->insert(array (
			0 => 
			array (
				'id' => 1,
				'game_id' => 6,
				'team_a_score' => 1,
				'team_b_score' => 9,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 0,
			),
			1 => 
			array (
				'id' => 2,
				'game_id' => 11,
				'team_a_score' => 3,
				'team_b_score' => 2,
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
				'game_id' => 18,
				'team_a_score' => 1,
				'team_b_score' => 0,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
			3 => 
			array (
				'id' => 4,
				'game_id' => 24,
				'team_a_score' => 4,
				'team_b_score' => 3,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 661,
				'a_victory' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'game_id' => 31,
				'team_a_score' => 3,
				'team_b_score' => 1,
				'team_a_host' => 0,
				'team_b_host' => 0,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'game_time' => 600,
				'a_victory' => 1,
			),
		));
	}

}
