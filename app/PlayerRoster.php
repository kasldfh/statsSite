<?php
namespace App;

class PlayerRoster extends \Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player_roster';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function player() {
		return $this->hasOne('App\Player', 'id', 'player_id');
	}

	public function roster() {
		return $this->hasOne('App\Roster', 'id', 'roster_id');
	}
}
