<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Match extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'match_table';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function score() {
		return $this->hasOne('App\Models\ScoreType', 'id', 'score_type_id');
	}
	public function rostera() {
		return $this->hasOne('App\Models\Roster', 'id', 'roster_a_id');
	}
	public function rosterb() {
		return $this->hasOne('App\Models\Roster', 'id', 'roster_b_id');
	}
	public function event() {
		return $this->hasOne('App\Models\Event', 'id', 'event_id');
	}
	public function type() {
		return $this->hasOne('App\Models\MatchType', 'id', 'match_type_id');
	}

	public function getTeamsAttribute(){
		$teams = [];
		$teams[$this->rostera->id] = $this->rostera->team->name;
		$teams[$this->rosterb->id] = $this->rosterb->team->name;
		return $teams;
	}

	public function getTeamletterAttribute(){
		$teams = [];
		$teams['a'] = $this->rostera->team->name;
		$teams['b'] = $this->rosterb->team->name;
		return $teams;
	}
	public function games(){
		return $this->hasMany('App\Models\Game', 'match_id', 'id');
	}
}
