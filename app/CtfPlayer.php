<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ctf;
class CtfPlayer extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ctf_player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function game() {
        dd("made it to game in ctfplayer");
		return $this->hasOne("Ctf", "id", "ctf_id");
	}
}
