<?php
namespace App;

class Team extends \Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'team';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function rosters() {
		return $this->hasMany('App\Roster', 'team_id', 'id')->orderBy('created_at', 'DESC');
	}

	public function getCurrentAttribute() {
		$roster = $this->rosters->first();
		return $roster;
	}

	public function getMapCount() {
		$roster_a_match = Match::where("roster_a_id", $this->id)->get();
		$roster_b_match = Match::where("roster_b_id", $this->id)->get();

		$totalMaps = 0;

		foreach ($roster_a_match as $match) {
			$totalMaps += $match->a_map_count + $match->b_map_count;
		}

		return $totalMaps; 
	}

	public function getWinLossRatio() {

	}
}
