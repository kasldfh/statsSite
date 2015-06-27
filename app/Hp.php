<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Hp extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'hp';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function players() {
		return $this->hasMany('App\HpPlayer', 'hp_id', 'id');
	}
}
