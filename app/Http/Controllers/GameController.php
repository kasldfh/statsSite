<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Match;
use App\Models\Mode;
use App\Models\Map;
use App\Models\MapMode;
use App\Models\Game;
use App\Models\Ctf;
use App\Models\Hp;
use App\Models\Snd;
use App\Models\Uplink;
use App\Models\CtfPlayer;
use App\Models\UplinkPlayer;
use App\Models\HpPlayer;
use App\Models\SndPlayer;
use App\Models\SndRound;
use App\Models\Item;
use App\Models\Pick;
use App\Models\Event;
use App\Models\Specialist;
use App\Models\GameTitle;

use Input;
use Redirect;
use View;

class GameController extends BaseModeAdminController {

    public function __construct() {
        $this->middleware('auth');
    }
    public function create($id) {
        $match = Match::find($id);
        $event = Event::find($match->event_id);
        //dd($match);
        $modes = Mode::with('maplink.map')->where('game_title_id', $event->game_title_id)->get();
        $mode_map = [];
        foreach ($modes as $mode) {
            foreach ($mode->maplink as $maplink) {
                $mode_map[$mode->id][$maplink->map->id] = $maplink->map->name;
            }
        }
        $event = Event::where('id', $match->event_id)->first();
        $items = Item::where('game_title_id', $event->game_title_id)->get();
        $items = $items->lists('name', 'id');
        $pick_types = ['1'=> 'Protect', 
            '2' => 'Ban', 
            '3' => 'Missed',
            '4' => 'No Choice'];
        $specialists = Item::where('type', 'Specialist')->lists('name', 'id');

        $stats = $this->queryMlg();
        $maps = [];
        foreach($stats as $name => $player) {
            foreach($player->history as $map) {
                if(!isset($maps[$map->map_id])) {
                    $map_obj = [
                        "map_id" => $map->map_id,
                        "map" => $map->map, 
                        "gametype" => $map->gametype,
                        "winner" => $map->winner,
                        "loser" => $map->loser
                    ];
                    $maps[$map->map_id] = json_encode($map_obj);
                }

            }
        }
        krsort($maps);
        $maps = ['' => "Choose a MLG Map"] + $maps;
        return View::make('admin.game.create', 
            compact('modes', 'match', 'mode_map', 'items', 'pick_types', 'specialists', 'maps'));
    }

    //todo: reduce number of calls to MLG api if possible
    public function getMlgGame($id) {
        //TODO: change this depending on the current game id. 
        //For now it's IW, so we will just enter that. 
        $game_title = GameTitle::where('title', 'Infinite Warfare')->first();
        $game_title_id = $game_title->id;

        $stats = $this->queryMlg();
        $players = [];
        foreach($stats as $name => $player) {
            foreach($player->history as $map) {
				/* var_dump($map); */
				//translate differences in names between mlg and us
				//TODO: convert to a switch statement
				if($name == "josh") {
					$name = "joshh";
				}
				if($name == "nial") {
					$name = "niall";
				}
				if($name == "mochilla") {
					$name = "mochila";
				}
				if($name == "joe") {
					$name = "joee";
				}
				if($map->map_id == $id) {
					//convert gametype to gametypes (1
					if($map->gametype == "hp") {
						$db_mode = Mode::where('name', 'Hardpoint')->where('game_title_id', $game_title_id)->first();

						$map->gametype = $db_mode->id;
					}
					elseif($map->gametype == "snd") {
						$db_mode = Mode::where('name', 'Search and Destroy')->where('game_title_id', $game_title_id)->first();
						$map->gametype = $db_mode->id;
					}
					elseif($map->gametype == "up") {
						$db_mode = Mode::where('name', 'Uplink')->where('game_title_id', $game_title_id)->first();
						$map->gametype = $db_mode->id;

					}
					elseif($map->gametype == "ctf") {
						$db_mode = Mode::where('name', 'Capture the Flag')->where('game_title_id', $game_title_id)->first();

						$map->gametype = $db_mode->id;
					}
					else {
						var_dump("wtf_gamecontroller");
					}
					$map_arr = (array) $map;
					$players[] = ["player_name" => $name] + $map_arr;
					/* print("Player:\t$name\t\t, kils:\t$map->kills, deaths:\t$map->deaths, map:$map->map, gametype:$map->gametype\n"); */
				}
			}
		}
		$json_players = json_encode($players);
		/* var_dump($players); */
		return $json_players;
	}

	//returns json_decoded mlg stats/player/all
	public function queryMlg() {
		//TODO: fail gracefully if the response isn't what's expected
		$response = file_get_contents('http://cod.majorleaguegaming.com/stats/player/all');
		$stats = json_decode($response);
		return $stats;

	}

	//if needed, paste json to mock mlg's server
	public function mock() {
		return "";
	}

	public function manage($id) {
		$games = Match::find($id)->games;
		foreach($games as $game) {
			$game->map = $game->map()->first()->name;
			$game->mode =  $game->mode()->first()->name;
		}
		return View::make('admin.game.manage', compact('games'));
	}
	public function edit($id) {
		parent::cacheRemove("stat*");
		$game = Game::findOrFail($id);
		$match = $game->match()->first();
		$modes = Mode::with('maplink.map')->get();
		$maps = Map::all();
		$mode_map = [];
		foreach ($modes as $mode) {
			foreach ($mode->maplink as $maplink) {
				$mode_map[$mode->id][$maplink->map->id] = $maplink->map->name;
			}
		}
		$mode = $game->mode()->first();
		$game->mode = $mode;
		$map = $game->map()->first();
		$game->map = $map;
		$mode;
		if($game->hp()->first())
		{
			$mode = $game->hp()->first();
			return Redirect::action('HpController@edit', ['id' => $id]);
		}
		else if ($game->ctf()->first())
		{
			$mode = $game->ctf()->first();
			return Redirect::action('CtfController@edit', ['id' => $id]);
		}
		else if($game->uplink()->first())
		{
			$mode = $game->uplink()->first();
			return Redirect::action('UplinkController@edit', ['id' => $id]);
		}
		else if($game->snd()->first())
		{
			$mode = $game->snd()->first();
			return Redirect::action('SndController@edit', ['id' => $id]);
		}
		else
			dd("wtf");
	}


	public function store() {
		//DBug::DBug(Input::all(), true);
		parent::cacheRemove("stat*");
		$mode = Input::get('mode');
		$mode = Mode::find($mode);
		$match = Match::find(Input::get('match_id'));
		$host = Input::get('host');
		$pHost = Input::get('p_host');
		$roster_a = $match->rostera->id;
		$roster_b = $match->rosterb->id;
		$map = Input::get('map');
		$map_mode = MapMode::where('map_id', $map)->where('mode_id', $mode->id)->first();
		$game = new Game;
		$game->match_id = $match->id;
		$game->game_number = Input::get('game_num');
		$game->map_mode_id = $map_mode->id;
		$game->score_type_id = Input::get('score_type_id');
		$game->save();

		//do picks and bans stuff
		//TODO:get if event has pickban or not...
		//if($event->has_picks) {
		$pickers = Input::get('pickers');
		for($i = 1; $i <= 8; $i++) {
			//if there was a pick
			if($pickers[$i-1]) {
				$pick = new Pick;
				$pick->game_id = $game->id;
				$pick->player_id = $pickers[$i-1];
				if($pick_types[$i-1] == 1 || $pick_types[$i-1] == 2) {
					$pick->item_id = $pick_items[$i-1];
				}
				$pick->number = $i;
				$pick->pick_type = $pick_types[$i-1];
				$pick->save();
			}
		}

		//specialists selection
		$specialist_players = Input::get('specialist_players');
		$specialists = Input::get('specialists');
		for($i = 1; $i <= 8; $i++) {
			$specialist = new Specialist;
			$specialist->game_id = $game->id;
			$specialist->player_id = $specialist_players[$i-1];
			$specialist->specialist_id = $specialists[$i-1];
			$specialist->save();
		}


		if($mode->name == 'Search and Destroy') {
			return $this->createSnd($game->id);
		}

		elseif($mode->name == 'Capture the Flag') {
			$ctf = new Ctf;
			$ctf->game_id = $game->id;
			$ctf->team_host_id = $host;
			$ctf->team_a_score = Input::get('a_ctf_score');
			$ctf->team_b_score = Input::get('b_ctf_score');
			$ctf->game_time = Input::get('minutes') * 60 + Input::get('seconds');
			$ctf->save();
			if($ctf->team_a_score > $ctf->team_b_score) {
				$match->a_map_count++;
			} 
			else {
				$match->b_map_count++;
			}
			$match->save();
			$players = Input::get('ctf_player');
			$ctf_kills = Input::get('ctf_kills');
			$ctf_deaths = Input::get('ctf_deaths');
			$ctf_captures = Input::get('ctf_captures');
			$ctf_defends = Input::get('ctf_defends');
			$returns = Input::get('returns');
			foreach ($players as $i => $player) {
				$ctf_player = new CtfPlayer;
				$ctf_player->ctf_id = $ctf->id;
				$ctf_player->player_id = $player;
				$ctf_player->kills = $ctf_kills[$i];
				$ctf_player->deaths = $ctf_deaths[$i];
				$ctf_player->captures = $ctf_captures[$i];
				$ctf_player->defends = $ctf_defends[$i];
				$ctf_player->returns = $returns[$i];
				$ctf_player->host = $pHost == $player;
				$ctf_player->save();
			}
		}
		elseif($mode->name == 'Uplink') {
			$uplink = new Uplink;
			$uplink->game_id = $game->id;
			$uplink->team_host_id = $host;
			$uplink->team_a_score = Input::get('a_uplink_score');
			$uplink->team_b_score = Input::get('b_uplink_score');
			$uplink->game_time = Input::get('minutes') * 60 + Input::get('seconds');
			$uplink->save();
			if($uplink->team_a_score > $uplink->team_b_score) {
				$match->a_map_count++;
			} else {
				$match->b_map_count++;
			}
			$match->save();
			$players = Input::get('uplink_player');
			$uplink_kills = Input::get('uplink_kills');
			$uplink_deaths = Input::get('uplink_deaths');
			$uplinks = Input::get('uplinks');
			$shots = Input::get('shots');
			$misses = Input::get('misses');
			$carries = Input::get('uplink_carries');
			$throws = Input::get('uplink_throws');
			foreach ($players as $i => $player) {
				$uplink_player = new UplinkPlayer;
				$uplink_player->uplink_id = $uplink->id;
				$uplink_player->player_id = $player;
				$uplink_player->kills = $uplink_kills[$i];
				$uplink_player->deaths = $uplink_deaths[$i];
				$uplink_player->uplinks = $uplinks[$i];
				$uplink_player->makes = $shots[$i];
				$uplink_player->misses = $misses[$i];
				$uplink_player->host = $pHost == $player;
				$uplink_player->carries = $carries[$i];
				$uplink_player->throws = $throws[$i];
				$uplink_player->save();
			}
		}
		elseif($mode->name == 'Hardpoint') {
			$hp = new Hp;
			$hp->team_host_id = $host;
			$hp->game_id = $game->id;
			$hp->team_a_score = Input::get('a_hp_score');
			$hp->team_b_score = Input::get('b_hp_score');
			$hp->game_time = Input::get('minutes') * 60 + Input::get('seconds');
			$hp->save();
			if($hp->team_a_score > $hp->team_b_score) {
				$match->a_map_count++;
			} else {
				$match->b_map_count++;
			}
			$match->save();
			$players = Input::get('hp_player');
			$hp_kills = Input::get('hp_kills');
			$hp_deaths = Input::get('hp_deaths');
			//$hp_captures = Input::get('hp_captures');
			$hp_time = Input::get('hp_time');
			$hp_defends = Input::get('hp_defends');
			foreach ($players as $i => $player) {
				$hp_player = new HpPlayer;
				$kills = $hp_kills[$i];
				$deaths = $hp_deaths[$i];
				//$time = $hp_time[$i];

				$player_time = explode(':', str_replace('.', ':', $hp_time[$i]));
				$time;
				if(sizeof($player_time)) {
					$time = 60 * $player_time[0];
					if(sizeof($player_time) == 2) {
						$time += $player_time[1];
					}
				}

				$defends = $hp_defends[$i];

				$hp_player->hp_id = $hp->id;
				$hp_player->player_id = $player;
				$hp_player->kills = $kills;
				$hp_player->deaths = $deaths;
				$hp_player->time = $time;
				$hp_player->defends = $defends;
				$hp_player->host = $pHost == $player;
				$hp_player->save();
				/* var_dump($hp_player->kills); */
			}
		}
		return Redirect::action('MatchController@manage');
		}

		public function delete($id) {
			//delete game
			//update map count in match
			//delete mode
			//delete mode players
			//delete picks
			$game = Game::find($id);
			$match = Match::find($game->match_id);
			//delete map and players
			$mode;
			if($game->hp()->first()) {
				$mode = $game->hp()->first();
				HpPlayer::where('hp_id', $mode->id)->delete();
			}
			if($game->ctf()->first()) {
				$mode = $game->ctf()->first();
				CtfPlayer::where('ctf_id', $mode->id)->delete();
			}
			if($game->uplink()->first()) {
				$mode = $game->uplink()->first();
				UplinkPlayer::where('uplink_id', $mode->id)->delete();
			}
			if($game->snd()->first()) {
				$mode = $game->snd()->first();
				SndPlayer::where('snd_id', $game->id)->delete();
				SndRound::where('snd_id', $game->id)->delete();
			}


			//update map counts for the match
			if($mode->team_a_score > $mode->team_b_score) {
				$match->a_map_count--;
			}
			if($mode->team_b_score > $mode->team_a_score) {
				$match->b_map_count--;
			}
			$match->save();

			//delete mode
			$mode->delete();

			//delete picks
			Pick::where('game_id', $game->id)->delete();

			//delete game
			Game::destroy($id);
			return Redirect::action('GameController@manage', ['id' => $match->id ]);
		}

		public function createSnd($game_id) {
			//TODO: need to remove SndPlayers where player was "unselected"
			//dd(Input::all());
			$match = Match::find(Input::get('match_id'));
			$game = Game::find($game_id);
			$mode = new Snd;

			$kills = Input::get('snd_kills');
			$deaths = Input::get('snd_deaths');
			$plants = Input::get('snd_plants');
			$defuses = Input::get('snd_defuses');
			//$defends = Input::get('snd_defends');
			$playerids = Input::get('snd_player');
			//round stuff
			$sides = Input::get('side');
			$fbs = Input::get('fb');
			$sites = input::get('site');
			$planters = Input::get('planter');
			$lms = Input::get('lms');
			$victors = Input::get('victor');
			$aplayers = [];

			//next, set snd variables
			//TODO:set host stuff
			$mode->team_a_score = Input::get('a_score');
			$mode->team_b_score = Input::get('b_score');
			$mode->game_time = Input::get('minutes') * 60 + Input::get('seconds');
			$mode->a_victory = $mode->team_a_score > $mode->team_b_score ? 1 : 0;
			$mode->game_id = $game->id;
			$mode->team_host_id = Input::get('host');
			$phost = Input::get('p_host');
			$mode->save();
			//update map count
			if($mode->team_a_score > $mode->team_b_score) {
				$match->a_map_count++;
			} 
			else {
				$match->b_map_count++;
			}
			$match->save();

			$rounds = [];
			for($i = 1; $i <= $mode->team_a_score + $mode->team_b_score; $i++)
			{
				$round = new SndRound;
				$round->snd_id = $mode->id;
				$round->round_number = $i;
				$round->side_won = $sides[$i-1];
				$round->victor_id = $victors[$i-1];
				$round->fb_player_id = $fbs[$i-1];
				$round->lms_player_id = $lms[$i-1];
				$round->planter_id = $planters[$i-1];
				$round->plant_site = $sites[$i-1];
				//dd($round->plant_site);
				$round->save();
				$rounds[] = $round;
			}
			//dd($rounds);
			//TODO: set team snd stats (plants/etc)

			//set new players
			$i = 0;
			foreach($playerids as $playerid) {
				//select the proper roster (first 4 are a, second 4 are b)
				$roster_id = $match->roster_a_id;
				if($i >= 4) {
					$roster_id = $match->roster_b_id;
				}
				$player = new SndPlayer;
				$player->player_id = $playerid;
				$player->snd_id = $mode->id;
				$player->kills = $kills[$i];
				$player->deaths = $deaths[$i];
				$player->plants = $plants[$i];
				$player->defuses = $defuses[$i];
				$player->first_bloods = parent::fbs($rounds, $playerid);
				$player->first_blood_wins = parent::fbWins($rounds, $playerid, $roster_id);
				$player->last_man_standing = parent::lms($rounds, $playerid);
				$player->last_man_standing_wins = parent::lmsWins($rounds, $playerid, $roster_id);
				$player->host = $phost ? $phost : null;
				$player->save();
				$i++;
				//TODO: host stuff
			}
			return Redirect::action('MatchController@manage');
		}
	}
