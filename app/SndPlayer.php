<?php
namespace App;

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
		return $this->hasOne("App\Snd", "id", "snd_id");
	}

    public function player() {
        return $this->hasOne('App\Player', 'id', 'player_id');
    }
}
