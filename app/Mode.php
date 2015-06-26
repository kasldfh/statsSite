<?php
namespace App;

class Mode extends \Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mode';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function title() {
		return $this->hasOne('App\GameTitle', 'id', 'game_title_id');
	}

	public function maplink(){
		return $this->hasMany('App\MapMode', 'mode_id', 'id');
	}

}
