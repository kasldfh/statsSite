<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class RosterEvent extends Model {
    public $timestamps = true; 
    protected $table = 'roster_event'

    public function roster() {
        return $this->hasOne('App\Roster', 'roster_id', 'id');
    }

    public function event() {
        return $this->hasOne('App\Event', 'event_id', 'id');
    }
}

