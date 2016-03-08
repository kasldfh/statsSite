<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class RosterEvent extends Model {
    public $timestamps = true; 
    protected $table = 'roster_event';

    public function roster() {
        return $this->hasOne('App\Models\Roster', 'id', 'roster_id');
    }

    public function event() {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    public function getWins() {
        $matches = Match::where('event_id', $this->event_id)->get();
        $wins = 0;
        foreach($matches as $match) {
            if($match->roster_a_id == $this->roster_id) {
                if($match->a_map_count > $match->b_map_count) {
                    $wins++;
                }
            }
            if($match->roster_b_id == $this->roster_id) {
                if($match->b_map_count > $match->a_map_count) {
                    $wins++;
                }
            }
        }
        return $wins;
    }

    public function getLosses() {
        $matches = Match::where('event_id', $this->event_id)->get();
        $losses = 0;
        foreach($matches as $match) {
            if($match->roster_a_id == $this->roster_id) {
                if($match->a_map_count < $match->b_map_count) {
                    $losses++;
                }
            }
            if($match->roster_b_id == $this->roster_id) {
                if($match->b_map_count < $match->a_map_count) {
                    $losses++;
                }
            }
        }
        return $losses;
    }

    public function getWinPercent() {
        $wins = $this->getWins();
        $losses = $this->getLosses();
        $total = $wins + $losses;
        if($total > 0) {
            return ($wins / $total) * 100;
        }
        else {
            return 0;
        }
    }

    public function getMapWins() {
        $roster_id = $this->roster_id;
        $wins = 0;
        //TODO: refactor this
        $matches = Match::where('event_id', $this->event_id)->get();
        foreach($matches as $match) {
            if($match->roster_a_id == $roster_id) {//|| $match->roster_b_id == $roster_id) {
                $wins += $match->a_map_count;
            }
            if($match->roster_b_id == $roster_id) {
                $wins += $match->b_map_count;
            }
        }
        return $wins;
    }

    public function getMapLosses() {
        $roster_id = $this->roster_id;
        $losses = 0;
        //TODO: refactor this
        $matches = Match::where('event_id', $this->event_id)->get();
        foreach($matches as $match) {
            if($match->roster_a_id == $roster_id) {//|| $match->roster_b_id == $roster_id) {
                $losses += $match->b_map_count;
            }
            if($match->roster_b_id == $roster_id) {
                $losses += $match->a_map_count;
            }
        }
        return $losses;
    }

    //TODO:finish this
    public function getKd () {
        $starters = $this->roster->starters()->get();
        //get hp, uplink, snd, ctf kills and deaths
        foreach(Match::where('event_id', $this->event_id)->get() as $match) {
            if($match->rostera()->first()->id == $this->roster_id || $match->rosterb()->first()->id  == $this->roster_d) {
                dd($match);

            }
        
        }
    }
}
