<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('users')->delete();
        
		\DB::table('users')->insert(array (
			0 => 
			array (
				'id' => 2,
				'name' => 'f41lurizer',
				'email' => 'masterpwnr@gmail.com',
				'password' => '',
				'admin' => 1,
				'token' => '',
				'created_at' => '2015-06-30 02:40:21',
				'updated_at' => '2015-06-30 02:40:21',
			),
		));
	}

}
