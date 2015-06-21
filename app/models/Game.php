<?php


class Game extends Eloquent {

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
		return $this->hasMany('Hp', 'game_id', 'id');
	}

	public function ctf() {
		return $this->hasMany('Ctf', 'game_id', 'id');
	}

	public function snd() {
		return $this->hasMany('Snd', 'game_id', 'id');
	}

	public function uplink() {
		return $this->hasMany('Uplink', 'game_id', 'id');
	}

}
