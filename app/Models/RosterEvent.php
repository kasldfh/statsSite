<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class RosterEvent extends Model {
    public $timestamps = true; 
    protected $table = 'roster_event';

    public function roster() {
        return $this->hasOne('App\Models\Roster', 'roster_id', 'id');
    }

    public function event() {
        return $this->hasOne('App\Models\Event', 'event_id', 'id');
    }
}

