<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Item extends Model {
    public $timestamps = true; 
    protected $table = 'item';

    public function game() {
        return $this->hasOne('App\Models\GameTitle', 'id', 'game_title_id');
    }
    
}

