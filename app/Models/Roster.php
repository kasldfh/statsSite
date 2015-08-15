<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roster';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function playermap() {
		return $this->hasMany('App\Models\PlayerRoster', 'roster_id', 'id')->with('player');
	}

	public function getPlayersAttribute() {
		$roster = [];
		foreach ($this->playermap as $playermap) {
			$roster[$playermap->player->id] = $playermap->player->alias;
		}
		return $roster;
	}
	public function team() {
		return $this->hasOne('App\Models\Team', 'id', 'team_id');
	}

	public function getCurrentAttribute() {
		$first = Roster::where('team_id', $this->team_id)->orderBy('created_at', 'DESC')->first();
		return ($this->id == $first->id);
	}

}
