<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GameTitle;
use App\Mode;
use View;
class ModeController extends Controller {
	public function __construct() {
    	$this->beforeFilter('auth');
	}

	public function create() {
		$game_titles = GameTitle::all();
		return View::make('admin.mode.create', compact('game_titles'));
	}

	public function store() {
		$mode = new Mode;
		$mode->name = Input::get('mode_name');
		$mode->game_title_id = Input::get('game_title');
		$mode->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$modes = Mode::all();
		return View::make('admin.mode.manage', compact('modes'));
	}

	public function delete($id) {
		Mode::destroy($id);
		return Redirect::action('ModeController@manage');
	}
}

	
