<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PlayerRoster extends Model {

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
		return $this->hasOne('App\Models\Models\Player', 'id', 'player_id');
	}

	public function roster() {
		return $this->hasOne('App\Models\Models\Roster', 'id', 'roster_id');
	}
}
