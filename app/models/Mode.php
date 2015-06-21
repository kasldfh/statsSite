<?php


class Mode extends Eloquent {

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
		return $this->hasOne('GameTitle', 'id', 'game_title_id');
	}

	public function maplink(){
		return $this->hasMany('MapMode', 'mode_id', 'id');
	}

}
