<?php

use Illuminate\Database\Seeder;

class PlayerRosterTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('player_roster')->delete();
        
		\DB::table('player_roster')->insert(array (
			0 => 
			array (
				'id' => 1,
				'roster_id' => 1,
				'player_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'roster_id' => 1,
				'player_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			2 => 
			array (
				'id' => 3,
				'roster_id' => 1,
				'player_id' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			3 => 
			array (
				'id' => 4,
				'roster_id' => 1,
				'player_id' => 4,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			4 => 
			array (
				'id' => 5,
				'roster_id' => 2,
				'player_id' => 5,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			5 => 
			array (
				'id' => 6,
				'roster_id' => 2,
				'player_id' => 6,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			6 => 
			array (
				'id' => 7,
				'roster_id' => 2,
				'player_id' => 7,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			7 => 
			array (
				'id' => 8,
				'roster_id' => 2,
				'player_id' => 8,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			8 => 
			array (
				'id' => 9,
				'roster_id' => 3,
				'player_id' => 9,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			9 => 
			array (
				'id' => 10,
				'roster_id' => 3,
				'player_id' => 10,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			10 => 
			array (
				'id' => 11,
				'roster_id' => 3,
				'player_id' => 11,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			11 => 
			array (
				'id' => 13,
				'roster_id' => 3,
				'player_id' => 12,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			12 => 
			array (
				'id' => 14,
				'roster_id' => 4,
				'player_id' => 13,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			13 => 
			array (
				'id' => 15,
				'roster_id' => 4,
				'player_id' => 14,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			14 => 
			array (
				'id' => 16,
				'roster_id' => 4,
				'player_id' => 15,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			15 => 
			array (
				'id' => 17,
				'roster_id' => 4,
				'player_id' => 16,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			16 => 
			array (
				'id' => 18,
				'roster_id' => 5,
				'player_id' => 18,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			17 => 
			array (
				'id' => 19,
				'roster_id' => 5,
				'player_id' => 19,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			18 => 
			array (
				'id' => 20,
				'roster_id' => 5,
				'player_id' => 20,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			19 => 
			array (
				'id' => 21,
				'roster_id' => 5,
				'player_id' => 21,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			20 => 
			array (
				'id' => 22,
				'roster_id' => 6,
				'player_id' => 22,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			21 => 
			array (
				'id' => 23,
				'roster_id' => 6,
				'player_id' => 23,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			22 => 
			array (
				'id' => 24,
				'roster_id' => 6,
				'player_id' => 24,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			),
			23 => 
			array (
				'id' => 25,
				'roster_id' => 6,
				'player_id' => 25,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'starter' => 1,
			)
		));
	}

}
