<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Game extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function hp() {
		return $this->hasMany('App\Hp', 'game_id', 'id');
	}

	public function ctf() {
		return $this->hasMany('App\Ctf', 'game_id', 'id');
	}

	public function snd() {
		return $this->hasMany('App\Snd', 'game_id', 'id');
	}

	public function uplink() {
		return $this->hasMany('App\Uplink', 'game_id', 'id');
	}

}
