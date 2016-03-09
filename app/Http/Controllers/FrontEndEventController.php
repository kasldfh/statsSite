<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;

use View;
	
class FrontEndEventController extends BaseController {

	public function viewEvent($id) {
        $event = parent::cacheGet("event:$id");
        if($event == null) {
            dd();
        }

        //get top performers
        $topkd = parent::cacheGet("stat:topkd:$id:all");
        $topslayer = parent::cacheGet("stat:topslayer:$id:all");
        $tophp_time = parent::cacheGet("stat:tophp_time:$id:all");
        $topul_dunks = parent::cacheGet("stat:topuplink_dunks:$id:all");
        $rosters = parent::cacheGet("rosterevent:$id:all");

        $players = parent::cacheGet('stat:kd:'.$id.':all');

        return View::make('frontend.event-standings', 
            compact('event', 'topkd', 'topslayer', 'tophp_time', 'topul_dunks',
                'rosters', 'players'));
	}

    public function viewGameTypeStatsByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-game-type', compact('event'));
    }

    public function viewLeaderboardsByEvent($id) {
        $event = Event::findorfail($id);
        $players = parent::cacheGet('stat:kd:'.$id.':all');
        return View::make('frontend.event-leaderboards', 
            compact('event', 'players'));
    }

    public function viewPickBanStatsByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-picks-bans', compact('event'));
    }

    public function viewRecordsByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-records', compact('event'));
    }

    public function viewSpecialistsByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-specialists', compact('event'));
    }

    public function viewStdevByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-stdev', compact('event'));
    }

}
