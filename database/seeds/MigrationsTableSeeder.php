<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('migrations')->delete();
        
		\DB::table('migrations')->insert(array (
			0 => 
			array (
				'migration' => '2014_10_12_000000_create_users_table',
				'batch' => 1,
			),
			1 => 
			array (
				'migration' => '2014_10_12_100000_create_password_resets_table',
				'batch' => 1,
			),
			2 => 
			array (
				'migration' => '2015_06_14_225725_create_ctf_player_table',
				'batch' => 1,
			),
			3 => 
			array (
				'migration' => '2015_06_14_225725_create_ctf_table',
				'batch' => 1,
			),
			4 => 
			array (
				'migration' => '2015_06_14_225725_create_event_table',
				'batch' => 1,
			),
			5 => 
			array (
				'migration' => '2015_06_14_225725_create_event_type_table',
				'batch' => 1,
			),
			6 => 
			array (
				'migration' => '2015_06_14_225725_create_game_table',
				'batch' => 1,
			),
			7 => 
			array (
				'migration' => '2015_06_14_225725_create_game_title_table',
				'batch' => 1,
			),
			8 => 
			array (
				'migration' => '2015_06_14_225725_create_hp_player_table',
				'batch' => 1,
			),
			9 => 
			array (
				'migration' => '2015_06_14_225725_create_hp_table',
				'batch' => 1,
			),
			10 => 
			array (
				'migration' => '2015_06_14_225725_create_map_mode_table',
				'batch' => 1,
			),
			11 => 
			array (
				'migration' => '2015_06_14_225725_create_map_table',
				'batch' => 1,
			),
			12 => 
			array (
				'migration' => '2015_06_14_225725_create_match_table_table',
				'batch' => 1,
			),
			13 => 
			array (
				'migration' => '2015_06_14_225725_create_match_type_table',
				'batch' => 1,
			),
			14 => 
			array (
				'migration' => '2015_06_14_225725_create_mode_table',
				'batch' => 1,
			),
			15 => 
			array (
				'migration' => '2015_06_14_225725_create_password_reminders_table',
				'batch' => 1,
			),
			16 => 
			array (
				'migration' => '2015_06_14_225725_create_player_roster_table',
				'batch' => 1,
			),
			17 => 
			array (
				'migration' => '2015_06_14_225725_create_player_table',
				'batch' => 1,
			),
			18 => 
			array (
				'migration' => '2015_06_14_225725_create_roster_table',
				'batch' => 1,
			),
			19 => 
			array (
				'migration' => '2015_06_14_225725_create_roster_to_event_table',
				'batch' => 1,
			),
			20 => 
			array (
				'migration' => '2015_06_14_225725_create_score_type_table',
				'batch' => 1,
			),
			21 => 
			array (
				'migration' => '2015_06_14_225725_create_snd_player_table',
				'batch' => 1,
			),
			22 => 
			array (
				'migration' => '2015_06_14_225725_create_snd_table',
				'batch' => 1,
			),
			23 => 
			array (
				'migration' => '2015_06_14_225725_create_team_table',
				'batch' => 1,
			),
			24 => 
			array (
				'migration' => '2015_06_14_225725_create_uplink_player_table',
				'batch' => 1,
			),
			25 => 
			array (
				'migration' => '2015_06_14_225725_create_uplink_table',
				'batch' => 1,
			),
		));
	}

}
