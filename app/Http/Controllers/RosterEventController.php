<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Redirect;

use App\Models\Event;
use App\Models\RosterEvent;
use App\Models\Roster;

class RosterEventController extends BaseController {

    public function __construct() {
        $this->middleware('auth');
    }

    public function create($id)
    {
        $event = Event::find($id);

        $with = ['playermap', 'team'];
        $allRosters = Roster::with($with)->orderBy('created_at', 'desc')->get();
        $rosters = [];
        foreach($allRosters as $roster)
        {
            $atEvent = RosterEvent::where('event_id', '=', $id)->
                where('roster_id', '=', $roster->id)->get();
            if(!count($atEvent))
                $rosters[] = $roster;
        }
        return view('admin.roster_event.create', compact('rosters', 'event'));
    }

    public function manage($id)
    {
        $event = Event::find($id);

        $eager_load = ['roster.team', 'roster', 'roster.playermap'];

        $roster_events = RosterEvent::with($eager_load)->
            where('event_id', $event->id)->get();
        return view('admin.roster_event.manage', compact('roster_events', 'event'));
    }

    public function store()
    {
        $event = Input::get('event_id');
        $roster = Input::get('roster_id');
        $exists = RosterEvent::where('roster_id', '=', $roster);
        $exists = $exists->where('event_id', '=', $event);
        if(!count($exists->get()))
        {
            $re = new RosterEvent;
            $re->roster_id = $roster;
            $re->event_id = $event;
            $re->save();
        }
        return Redirect::action('RosterEventController@create', 
            ['id' => Input::get('event_id')]);
    }

    public function delete()
    {
        $roster_event = RosterEvent::find(Input::get('id'));
        $roster_event->delete();
        return Redirect::action('RosterEventController@manage', 
            ['id' => $roster_event->event_id]);
    }

    public function edit_standings($id) {
        $event = Event::find($id);
        $roster_events = RosterEvent::where('event_id', $id)->with('roster')->get();
        return view('admin.roster_event.standings', compact('roster_events', 'event'));
    }

    public function update_standings() {
        $event_id = Input::get('event_id');
        $roster_events = RosterEvent::where('event_id', $event_id)->get();
        foreach($roster_events as $roster_event) {
            $placing = Input::get($roster_event->id);
            if(!empty($placing)) {
                $roster_event->placing = $placing;
                $roster_event->save();
            }
        }
        return Redirect::action('AdminController@dashboard');
    }
}
