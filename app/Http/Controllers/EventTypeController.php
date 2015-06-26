<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
	
class EventTypeController extends Controller {

	public function __construct() {
    	$this->beforeFilter('auth');
	}
	public function create() {
		return View::make('admin.event_type.create');
	}

	public function store() {
		$event_type = new EventType;
		$event_type->name = Input::get('event_type');
		$event_type->save();
		return Redirect::action('AdminController@dashboard');
	}

	
	public function manage() {
		$event_types = EventType::all();
		return View::make('admin.event_type.manage', compact('event_types'));
	}

	public function delete($id) {
		EventType::destroy($id);
		return Redirect::action('EventTypeController@manage');
	}

}
