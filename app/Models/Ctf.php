<?php
namespace App\Models;

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
        return $this->hasMany('App\Models\CtfPlayer', 'ctf_id', 'id');
    }

    public function game() {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }
}
