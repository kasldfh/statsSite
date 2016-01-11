<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Pick;
use App\Models\Event;

use Input;

class BaseModeAdminController extends Controller
{
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
    public function get_pick_items($event_id) {
        $event = Event::where('id', $event_id)->first();
        $items = Item::where('game_title_id', $event->game_title_id)->get();
        $items = $items->lists('name', 'id');
        return $items;
    }
}
