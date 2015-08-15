<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class UplinkPlayer extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'uplink_player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function game() {
		return $this->hasOne("App\Models\Models\Uplink", "id", "uplink_id");
	}

    public function player() {
        return $this->hasOne('App\Models\Models\Player', 'id', 'player_id');
    }
}
