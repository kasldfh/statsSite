<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Ctf extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ctf';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function players() {
		return $this->hasMany('CtfPlayer', 'ctf_id', 'id');
	}
}
