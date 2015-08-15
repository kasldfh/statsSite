<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class GameTitle extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game_title';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
}
