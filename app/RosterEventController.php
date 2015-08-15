<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use App\Event;
use App\RosterEvent;

class RosterEventController extends Controller {

    public function create()
    {
        return view('admin.dashboard', compact('event'));
        
    }
    public function manage($id)
    {
        $event = Event::find($id);
        $players = $event->
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
}
