<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MapMode extends Model {

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
		return $this->hasOne('App\Models\Map', 'id', 'map_id');
	}

	public function mode() {
		return $this->hasOne('App\Models\Mode', 'id', 'mode_id');
	}
}
