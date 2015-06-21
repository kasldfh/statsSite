<?php


class SndPlayer extends Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'snd_player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function game() {
		return $this->hasOne("Snd", "id", "snd_id");
	}
}
