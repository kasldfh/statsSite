<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
	
class MapController extends Controller {

	public function __construct() {
    	$this->beforeFilter('auth');
	}
	public function create() {
		$game_titles = GameTitle::all();
		return View::make('admin.map.create', compact('game_titles'));
	}

	public function store() {
		$map = new Map;
		$map->name = Input::get('map_name');
		$map->game_title_id = Input::get('game_title');
		$map->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$maps = Map::all();
		return View::make('admin.map.manage', compact('maps'));
	}

	public function delete($id) {
		Map::destroy($id);
		return Redirect::action('MapController@manage');
	}

}
