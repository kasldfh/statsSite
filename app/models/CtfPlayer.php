<?php
namespace App;

class CtfPlayer extends \Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ctf_player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function game() {
		return $this->hasOne("Ctf", "id", "ctf_id");
	}
}
