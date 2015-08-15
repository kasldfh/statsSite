<?php
namespace App\Models\Models\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Http\Requests;
use App\Models\Models\Http\Controllers\Controller;

use Input;
use App\Models\Models\Event;
use App\Models\Models\RosterEvent;

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
