<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event;

use View;
	
class FrontEndEventController extends Controller {

	public function viewEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event', compact('event'));
	}

    public function viewGameTypeStatsByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-game-type', compact('event'));
    }

    public function viewLeaderboardsByEvent($id) {
        $event = Event::findorfail($id);
		return View::make('frontend.event-leaderboards', compact('event'));
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
