<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('team')->delete();
        
		\DB::table('team')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'SSOF',
				'owner1' => NULL,
				'owner2' => NULL,
				'twitter' => NULL,
				'youtube' => NULL,
				'twitch' => NULL,
				'mlg_tv' => NULL,
				'web_url' => NULL,
				'team_color' => '',
				'logo_url' => NULL,
				'team_url' => '',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'flair' => NULL,
			),
			1 => 
			array (
				'id' => 2,
				'name' => 'Classic Team',
				'owner1' => NULL,
				'owner2' => NULL,
				'twitter' => NULL,
				'youtube' => NULL,
				'twitch' => NULL,
				'mlg_tv' => NULL,
				'web_url' => NULL,
				'team_color' => '',
				'logo_url' => NULL,
				'team_url' => '',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'flair' => NULL,
			),
			2 => 
			array (
				'id' => 3,
				'name' => 'Milgares Team',
				'owner1' => NULL,
				'owner2' => NULL,
				'twitter' => NULL,
				'youtube' => NULL,
				'twitch' => NULL,
				'mlg_tv' => NULL,
				'web_url' => NULL,
				'team_color' => '',
				'logo_url' => NULL,
				'team_url' => '',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'flair' => NULL,
			),
			3 => 
			array (
				'id' => 4,
				'name' => 'DOGS',
				'owner1' => NULL,
				'owner2' => NULL,
				'twitter' => NULL,
				'youtube' => NULL,
				'twitch' => NULL,
				'mlg_tv' => NULL,
				'web_url' => NULL,
				'team_color' => '',
				'logo_url' => NULL,
				'team_url' => '',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'flair' => NULL,
			),
			4 => 
			array (
				'id' => 5,
				'name' => 'Brazilla',
				'owner1' => NULL,
				'owner2' => NULL,
				'twitter' => NULL,
				'youtube' => NULL,
				'twitch' => NULL,
				'mlg_tv' => NULL,
				'web_url' => NULL,
				'team_color' => '',
				'logo_url' => NULL,
				'team_url' => '',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'flair' => NULL,
			),
			5 => 
			array (
				'id' => 6,
				'name' => 'Virtue Gaming',
				'owner1' => NULL,
				'owner2' => NULL,
				'twitter' => NULL,
				'youtube' => NULL,
				'twitch' => NULL,
				'mlg_tv' => NULL,
				'web_url' => NULL,
				'team_color' => '',
				'logo_url' => NULL,
				'team_url' => '',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
				'flair' => NULL,
			),
		));
	}

}
