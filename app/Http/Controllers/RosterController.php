<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Team;
use App\Player;
use App\Roster;
use Input;
use Redirect;
use View;
	
class RosterController extends Controller {

	public function __construct() {
        $this->middleware('auth');
	}

	public function create() {
		$teams = Team::all();
		$players = Player::all();
		return View::make('admin.roster.create', compact('teams', 'players'));
	}

	public function store() {
		if(count(Input::get('players')) > 4) {
			$input = Input::all();

			$players = $input['players'];
			$team = Team::find($input['team']);
			return Redirect::action('RosterController@fix')->with('players', $players)->with('team', $team);
		}
		$player_ids = Input::get('players');
		$players = Player::whereIn('id', $player_ids)->get();
		$roster = new Roster;
		$roster->team_id = Input::get('team');
		$roster->save();
		foreach ($players as $player) {
			//DBug::DBug($player->toArray(), true);
			$player_map = new PlayerRoster;
			$player_map->starter = 1;
			$player_map->player_id = $player->id;
			$player_map->roster_id = $roster->id;
			$player_map->save();
		}
		return Redirect::action('AdminController@dashboard');
	}

	public function fix() {
		$players = Player::whereIn('id', Session::get('players'))->get();
		$team = Session::get('team');
		return View::make('admin.roster.fix', compact('players', 'team'));
	}

	public function fixProcess() {
		$roles = Input::get('role');
		$team = Team::find(Input::get('team'));
		$roles_count = array_count_values($roles);
		$players = Player::whereIn('id', array_keys($roles))->get();
		if($roles_count['player'] != 4) {
			$players = array_keys($roles);
			return Redirect::action('RosterController@fix')->with('players', $players)->with('team', $team);
		}
		$roster = new Roster;
		$roster->team_id = $team->id;
		$roster->save();
		foreach ($players as $player) {
			//DBug::DBug($player->toArray(), true);
			$player_map = new PlayerRoster;
			$player_map->starter = $roles[$player->id] == 'player';
			$player_map->player_id = $player->id;
			$player_map->roster_id = $roster->id;
			$player_map->save();
		}
		return Redirect::action('AdminController@dashboard');
	}
	
	public function manage() {
		$rosters = Roster::all();
		return View::make('admin.roster.manage', compact('rosters'));
	}

	public function delete($id) {
		$players = PlayerRoster::where('roster_id', $id)->get();
		foreach ($players as $player) {
			$player->delete();
		}
		Roster::destroy($id);
		return Redirect::action('RosterController@manage');
	}
}
