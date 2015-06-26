<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class HpPlayer extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'hp_player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function game() {
		return $this->hasOne("App\Hp", "id", "hp_id");
	}
}
