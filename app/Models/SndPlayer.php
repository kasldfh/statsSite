<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class SndPlayer extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'snd_player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function game() {
		return $this->hasOne("App\Models\Snd", "id", "snd_id");
	}

    public function player() {
        return $this->hasOne('App\Models\Player', 'id', 'player_id');
    }
}
