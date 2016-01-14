<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
	public $timestamps = true; 
	protected $table = 'specialist';
	public function player() {
		return $this->hasOne('App\Models\Player', 'id', 'player_id');
	}

	public function specialist() {
		return $this->hasOne('App\Models\Item', 'id', 'specialist_id');
	}

	public function game() {
		return $this->hasOne('App\Models\Game', 'id', 'game_id');
	}
}
