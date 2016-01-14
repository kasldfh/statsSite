<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Pick;
use App\Models\Event;
use App\Models\Specialist;

use Input;

class BaseModeAdminController extends BaseController {
    public function update_picks($game_id) {
        $pickers = Input::get('pickers');
        $pick_types = Input::get('pick_types');
        $pick_items = Input::get('pick_items');
        $existing_picks = Pick::where('game_id', $game_id)->orderBy('number')->get();

        for($i = 1; $i <= 8; $i++) {
            //if there was a pick
            if($pickers[$i-1]) {
                $pick = new Pick;
                foreach($existing_picks as $existing_pick) {
                    if($existing_pick->number == $i) {
                        $pick = $existing_pick;
                    }
                }
                $pick->game_id = $game_id;
                $pick->player_id = $pickers[$i-1];
                if($pick_types[$i-1] == 1 || $pick_types[$i-1] == 2) {
                    $pick->item_id = $pick_items[$i-1];
                }
                $pick->number = $i;
                $pick->pick_type = $pick_types[$i-1];
                $pick->save();
            }
        }
    }

    public function update_specialist($game_id) {
        $specialist_players = Input::get('specialist_players');
        $specialists = Input::get('specialists');
        for($i = 1; $i <= 8; $i++) {
            if($specialist_players[$i-1]) {
                $specialist = Specialist::where([
                    'game_id' => $game_id, 
                    'player_id' => $specialist_players[$i-1]
                ])->first();
                if(!$specialist) {
                    $specialist = new Specialist;
                }
                $specialist->game_id = $game_id;
                $specialist->player_id = $specialist_players[$i-1];
                $specialist->specialist_id = $specialists[$i-1];
                $specialist->save();
            }
        }
    }

    public function get_specialists($event_id) {
        $event = Event::find($event_id);
        $specialists = Item::where([
            'game_title_id'=> $event->game_title_id,
            'type'=> 'Specialist'
        ])->get();
        $specialists = $specialists->lists('name', 'id');
        return $specialists;
    }

    public function get_specialist_players($game_id) {
        $specialists = Specialist::where('game_id', $game_id)->get();
        $specialists = $specialists->lists('specialist_id', 'player_id');
        return $specialists;
    }

    public function get_pick_items($event_id) {
        $event = Event::where('id', $event_id)->first();
        $items = Item::where('game_title_id', $event->game_title_id)->get();
        $items = $items->lists('name', 'id');
        return $items;
    }
    //snd methods
    public function fbs($rounds, $id)
    {
        $fbs = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->fb_player_id == $id)
                $fbs++;
            if($round->fb_player_id)
                $noRecs = false;
        }
        return $noRecs ? null : $fbs;
    }

    public function fbWins($rounds, $id, $roster_id)
    {
        $fbWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->fb_player_id == $id && $round->victor_id == $roster_id)
                $fbWins++;
            if($round->fb_player_id && $round->victor_id)
                $noRecs = false;
        }
        return $noRecs ? null : $fbWins;
    }

    public function lms($rounds, $id)
    {
        $lms = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->lms_player_id == $id)
                $lms++;
            if($round->lms)
                $noRecs = false;
        }
        return $noRecs ? null : $lms;
    }

    public function lmsWins($rounds, $id, $roster_id)
    {
        $lmsWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->lms_player_id == $id && $round->victor_id == $roster_id)
                $lmsWins++;
            if($round->lms && $round->victor_id)
                $noRecs = false;
        }
        return $noRecs ? null : $lmsWins;
    }

    //get wins for a particular site (offense or defense)
    public function sideWins($rounds, $roster_id, $side)
    {
        $sideWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->side_won == $side)
                $sideWins++;
            if($round->side_won)
                $noRecs = false;
        }
        return $noRecs ? null : $sideWins;
    }

    public function sitePlants($rounds, $site, $players) {
        $sitePlants = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            $containsPlanter = containsId($players, $round->planter_id);
            if($containsPlanter && $round->plant_site == $site)
                $sitePlants++;
            if($round->player_id && $round->plant_site)
                $noRecs = false;
        }
        return $noRecs ? null : $sitePlants;
    }

    public function sitePlantWins($rounds, $site, $players, $roster_id) {
        $plantWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            $containsPlanter = containsId($players, $round->planter_id);
            $isVictor = $round->victor_id == $roster_id;
            $isSite = $round->plant_site == $site;
            if($containsPlanter && $isSite && $isVictor)
                $plantWins++;
            if($round->player_id && $round->plant_site && $round->victor_id)
                $noRecs = false;
        }
        return $noRecs ? null : $plantWins;
    }

}
