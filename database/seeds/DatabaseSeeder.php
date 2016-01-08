<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        //$this->call('UserTableSeeder');
        //factory(App\User::class, 50)->create();

        //Model::reguard();
    	$this->call('PlayerTableSeeder');
		//$this->call('CtfTableSeeder');
		//$this->call('CtfPlayerTableSeeder');
		$this->call('EventTableSeeder');
		$this->call('EventTypeTableSeeder');
		//$this->call('GameTableSeeder');
		$this->call('GameTitleTableSeeder');
		//$this->call('HpTableSeeder');
		//$this->call('HpPlayerTableSeeder');
		$this->call('MapTableSeeder');
		$this->call('MapModeTableSeeder');
		//$this->call('MatchTableTableSeeder');
		$this->call('MatchTypeTableSeeder');
		$this->call('ModeTableSeeder');
		$this->call('PasswordRemindersTableSeeder');
		$this->call('PasswordResetsTableSeeder');
		$this->call('PlayerRosterTableSeeder');
		$this->call('RosterTableSeeder');
		$this->call('ScoreTypeTableSeeder');
		//$this->call('SndTableSeeder');
		//$this->call('SndPlayerTableSeeder');
		$this->call('TeamTableSeeder');
		//$this->call('UplinkTableSeeder');
		//$this->call('UplinkPlayerTableSeeder');
        //$this->call('ItemTableSeeder');
	}
}
