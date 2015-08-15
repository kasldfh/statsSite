<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Map extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'map';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function title() {
		return $this->hasOne('App\GameTitle', 'id', 'game_title_id');
	}
	
}
