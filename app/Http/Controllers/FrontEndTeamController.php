<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Team;
use App\Models\RosterEvent;

use View;
	
class FrontEndTeamController extends Controller {

    public function index() {
        return View::make('frontend.teams');
    }

	public function show($name) {
		$team = Team::where('name', 'like', $name)->first();
        //get list of roster ids for this team
        $rosters = $team->rosters()->get();
        $roster_ids = [];
        foreach($rosters as $roster) {
            $roster_ids[] = $roster->id;
        }

		$currentRoster = $team->getCurrentAttribute();
		$roster_event_starters = $currentRoster->starters()->get();
        $starters = [];
        foreach($roster_event_starters as $starter) {
            $starters[] = $starter->player()->first();
        }

        $rosterEvents = RosterEvent::whereIn('roster_id', $roster_ids)->with('event')->get();
        foreach($rosterEvents as &$rosterEvent) {
            $rosterEvent->wins = $rosterEvent->getWins();
            $rosterEvent->losses = $rosterEvent->getLosses();
            $rosterEvent->win_percent = $rosterEvent->getWinPercent();
            $rosterEvent->map_wins = $rosterEvent->getMapWins();
            $rosterEvent->map_losses = $rosterEvent->getMapLosses();
            //$rosterEvent->kd = $rosterEvent->getKd();
        }
		return View::make('frontend.team', compact('starters', 'rosterEvents')); 
	}
}
