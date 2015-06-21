<?php


class MapMode extends Eloquent {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'map_mode';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function map() {
		return $this->hasOne('Map', 'id', 'map_id');
	}

	public function mode() {
		return $this->hasOne('Mode', 'id', 'mode_id');
	}
}
