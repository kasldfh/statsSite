<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\GameTitle;
use Input;
use Redirect;
use View;
	
class GameTitleController extends Controller {

	public function __construct() {
        $this->middleware('auth');
	}
	public function create() {
		return View::make('admin.game_title.create');
	}

	public function store() {
		$game_title = new GameTitle;
		$game_title->title = Input::get('game_title');
		$game_title->save();
		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$game_titles = GameTitle::all();
		return View::make('admin.game_title.manage', compact('game_titles'));
	}
	public function delete($id) {
		GameTitle::destroy($id);
		return Redirect::action('GameTitleController@manage');
	}
}
