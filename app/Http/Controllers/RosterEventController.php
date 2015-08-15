<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;

use App\Models\Event;
use App\Models\RosterEvent;
use App\Models\Roster;

class RosterEventController extends BaseController {

    public function create($id)
    {
        $event = Event::find($id);

        $with = ['playermap', 'team'];
        $rosters = Roster::with($with)->orderBy('created_at', 'desc')->get();
        return view('admin.roster_event.create', compact('rosters', 'event'));
    }

    public function manage($id)
    {
        $event = Event::find($id);
        $players = $event->name;
    }

    public function store($id)
    {
        $event = Input::get('event_id');
        $roster = Input::get('roster_id');
        $re = new RosterEvent;
        $re->roster_id = $roster;
        $re->event_id = $event;
        $re->save();
    }

    public function delete($id)
    {
        
    }
}
