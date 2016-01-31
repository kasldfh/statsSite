<?php
namespace App\Models;

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

    public function game() {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }

    public function players() {
        return $this->hasMany('App\Models\SndPlayer', 'snd_id', 'id');
    }

    public function rounds() {
        return $this->hasMany('App\Models\SndRound', 'snd_id', 'id');
    }

}
