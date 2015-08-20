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
        $with = ['playermap', 'team'];
        $allRosters = Roster::with($with)->orderBy('created_at', 'desc')->get();
        $rosters = [];
        foreach($allRosters as $roster)
        {
            $atEvent = RosterEvent::where('event_id', '=', $id)->
                where('roster_id', '=', $roster->id)->get();
            if(count($atEvent))
                $rosters[] = $roster;
        }
        return view('admin.roster_event.manage', compact('rosters', 'event'));
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

    public function delete($roster_id, $event_id)
    {
        dd($event_id . $roster_id);
        RosterEvent::delete($id);
    }
}
