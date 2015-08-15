<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SndRound extends Model
{
	public $timestamps = true; 
	protected $table = 'snd_round';

	public function game() {
		return $this->hasOne("App\Models\Snd", "id", "snd_id");
	}
}
