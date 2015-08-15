<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CreateUser extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	//protected $connection = 'users';
	protected $table = 'user_creation';

}

