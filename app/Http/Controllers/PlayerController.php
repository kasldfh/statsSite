<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Player;
use Input;
use Redirect;
use View;
	
class PlayerController extends Controller {

	public function __construct() {
    	$this->beforeFilter('auth');
	}

	public function create() {
		return View::make('admin.player.create');
	}

	public function store() {
		$player = new Player;
		$player->first_name = Input::get('first_name');
		$player->last_name = Input::get('last_name');
		$player->alias = Input::get('alias');
		$player->hometown = Input::get('zipcode');
		if(Input::get('date','') != '') {
			$player->DOB = date('Y-m-d',strtotime(Input::get('date')));
		}
		$player->country = Input::get('country');
		$filename = str_random(12);
		$file = Input::file('logo');
		if(!empty(Input::file('logo'))) {
			$destinationPath = 'uploads/players';
			$extension = $file->getClientOriginalExtension();
			$filename = $player->id . str_random(12);
			$file->move($destinationPath, $filename . '.' . $extension);
			$url = asset('uploads/players/' . $filename . '.' . $extension);
			$player->photo_url = $url;
		}
		
		$player->save();

		return Redirect::action('AdminController@dashboard');
	}
	
	public function manage() {
		$players = Player::all();
		return View::make('admin.player.manage', compact('players'));
	}

	public function delete($id) {
		Player::destroy($id);
		return Redirect::action('PlayerController@manage');
	}
}
