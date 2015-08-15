<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Team;

use Input;
use Redirect;
use View;

class TeamController extends Controller {

	public function __construct() {
        $this->middleware('auth');
	}

	public function create() {
		return View::make('admin.team.create');
	}

	public function store() {
		$team = new Team;
		$filename = str_random(12);
		$file = Input::file('logo');
		if(!empty(Input::file('logo'))) {
			$destinationPath = 'uploads/team_logos';
			$extension = $file->getClientOriginalExtension();
			$filename = $team->id . str_random(12);
			$file->move($destinationPath, $filename . '.' . $extension);
			$url = asset('uploads/team_logos/' . $filename . '.' . $extension);
			$team->logo_url = $url;
		}
		$team->name = Input::get('name');
		$team->owner1 = Input::get('owner1');
		$team->owner2 = Input::get('owner2');
		$team->twitter = Input::get('twitter');
		$team->youtube = Input::get('youtube');
		$team->twitch = Input::get('twitch');
		$team->mlg_tv = Input::get('mlg_tv');
		$team->web_url = Input::get('web_url');
		$team->team_color = Input::get('color');
		$team->save();

		return Redirect::action('AdminController@dashboard');
	}

	public function manage() {
		$teams = Team::all();
		return View::make('admin.team.manage', compact('teams'));
	}

	public function delete($id) {
		Team::destroy($id);
		return Redirect::action('TeamController@manage');
	}
}
