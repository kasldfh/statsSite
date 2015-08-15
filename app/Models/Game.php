<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Game extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'game';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function hp() {
		return $this->hasOne('App\Models\Models\Hp', 'game_id', 'id');
	}

	public function ctf() {
		return $this->hasOne('App\Models\Models\Ctf', 'game_id', 'id');
	}

	public function snd() {
		return $this->hasOne('App\Models\Models\Snd', 'game_id', 'id');
	}

	public function uplink() {
		return $this->hasOne('App\Models\Models\Uplink', 'game_id', 'id');
	}
    //added by fail (all under this)
    public function mapmode() {
        $retval =  $this->hasOne('App\Models\Models\MapMode',  'id','map_mode_id');
        return $retval;
        //return $mapMode;
    }
    public function mode() {
        $mapMode =  $this->mapmode()->first();
        $mode = $mapMode->mode();
        //dd($mode);
        return $mode;
    }
    public function map() {
        $mapMode =  $this->mapmode()->first();
        $map = $mapMode->map();
        //dd($mode);
        return $map;
    }
    public function match()
    {
        return $this->belongsTo('App\Models\Models\Match');
    }

}
