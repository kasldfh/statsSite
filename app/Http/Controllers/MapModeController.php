<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Map;
use App\Models\Mode;
use App\Models\MapMode;

use Input;
use Redirect;
use View;

class MapModeController extends Controller {
	public function __construct() {
        $this->middleware('auth');
	}

public function create() {
		$maps = Map::all();
		$modes = Mode::all();
		return View::make('admin.map_mode.create', compact('maps', 'modes'));
	}

	public function store() {
		$map_mode = new MapMode;
		$map_mode->map_id = Input::get('map');
		$map_mode->mode_id = Input::get('mode');
		$map_mode->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$map_modes = MapMode::all();
		return View::make('admin.map_mode.manage', compact('map_modes'));
	}

	public function delete($id) {
		MapMode::destroy($id);
		return Redirect::action('MapModeController@manage');
	}
}
