<?php

use Illuminate\Database\Seeder;

class PasswordRemindersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('password_reminders')->delete();
        
	}

}
