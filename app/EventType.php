<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class EventType extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event_type';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
}
