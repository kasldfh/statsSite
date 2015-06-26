<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Snd extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'snd';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function players() {
		return $this->hasMany('SndPlayer', 'snd_id', 'id');
	}
}
