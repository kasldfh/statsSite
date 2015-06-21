<?php

class CreateUser extends Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $connection = 'users';
	protected $table = 'user_creation';

}

