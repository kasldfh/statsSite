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

use Input;
use Redirect;
use View;

class GameController extends BaseController {

    public function __construct() {
        $this->middleware('auth');
    }
    public function create($id) {
        $match = Match::find($id);
        //dd($match);
        $modes = Mode::with('maplink.map')->get();
        $mode_map = [];
        foreach ($modes as $mode) {
            foreach ($mode->maplink as $maplink) {
                $mode_map[$mode->id][$maplink->map->id] = $maplink->map->name;
            }

        }
        // DBug::DBug($match->rostera->players);
        // die();
        return View::make('admin.game.create', compact('modes', 'match', 'mode_map'));
    }
    public function manage($id) {
        $games = Match::find($id)->games;
        foreach($games as $game)
        {
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
        $game->save();

        if($mode->name == 'Search and Destroy') {
            return $this->createSnd();
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
            } else {
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
            $hp_captures = Input::get('hp_captures');
            $hp_defends = Input::get('hp_defends');
            foreach ($players as $i => $player) {
                $hp_player = new HpPlayer;
                $kills = $hp_kills[$i];
                $deaths = $hp_deaths[$i];
                $captures = $hp_captures[$i];
                $defends = $hp_defends[$i];

                $hp_player->hp_id = $hp->id;
                $hp_player->player_id = $player;
                $hp_player->kills = $kills;// == "" ? null : $kills;
                $hp_player->deaths = $deaths;// == "" ? null : $deaths;
                $hp_player->captures = $captures;// == "" ? null : $captures;
                $hp_player->defends = $defends;// == "" ? null : $defends;
                $hp_player->host = $pHost == $player;
                $hp_player->save();
                var_dump($hp_player->kills);
            }
        }
        return Redirect::action('MatchController@manage');
    }

    public function delete($id) {
        $match_id = Game::find($id)->match_id;
        Game::destroy($id);
        return Redirect::action('GameController@manage', ['id' => $match_id ]);
    }
    public function createSnd() {
        //TODO: need to remove SndPlayers where player was "unselected"
        //dd(Input::all());
        $match = Match::find(Input::get('match_id'));

        $game = new Game;
        $game->match_id = $match->id;
        $game->game_number = Input::get('game_num');

        $mode = new Snd;

        $kills = Input::get('kills');
        $deaths = Input::get('deaths');
        $plants = Input::get('plants');
        $defuses = Input::get('defuses');
        $defends = Input::get('defends');
        $aplayerids = Input::get('aplayers');
        //dd($aplayerids);
        $bplayerids = Input::get('bplayers');
        //round stuff
        $sides = Input::get('side');
        $fbs = Input::get('fb');
        $sites = input::get('site');
        $planters = Input::get('planter');
        $lms = Input::get('lms');
        $victors = Input::get('victor');
        $aplayers = [];
        //first, set game variables

        //TODO: refactor this to be dynamic
        $modeid = 4;
        $mapmode = MapMode::where('map_id', '=', Input::get('map'))->where('mode_id', '=', $modeid)->first();
        $game->map_mode_id = $mapmode->id;
        $game->save();
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
        foreach($aplayerids as $aplayerid)
        {
            $aplayer = new SndPlayer;
            $aplayer->player_id = $aplayerid;
            $aplayer->snd_id = $mode->id;
            $aplayer->kills = $kills[$i];
            $aplayer->deaths = $deaths[$i];
            $aplayer->plants = $plants[$i];
            $aplayer->defuses = $defuses[$i];
            $aplayer->first_bloods = $this->fbs($rounds, $aplayerid);
            $aplayer->first_blood_wins = $this->fbWins($rounds, $aplayerid, $match->roster_a_id);
            $aplayer->last_man_standing = $this->lms($rounds, $aplayerid);
            $aplayer->last_man_standing_wins = $this->lmsWins($rounds, $aplayerid, $match->roster_a_id);
            $aplayer->host = $phost ? $phost : null;
            $aplayer->save();
            $i++;
            //TODO: host stuff
        }

        foreach($bplayerids as $bplayerid)
        {
            $bplayer = new SndPlayer;
            $bplayer->player_id = $bplayerid;
            $bplayer->snd_id = $mode->id;
            $bplayer->kills = $kills[$i];
            $bplayer->deaths = $deaths[$i];
            $bplayer->plants = $plants[$i];
            $bplayer->defuses = $defuses[$i];
            $bplayer->first_bloods = $this->fbs($rounds, $bplayerid);
            $bplayer->first_blood_wins = $this->fbWins($rounds, $bplayerid, $match->roster_b_id);
            $bplayer->last_man_standing = $this->lms($rounds, $bplayerid);
            $bplayer->last_man_standing_wins = $this->lmsWins($rounds, $bplayerid, $match->roster_b_id);
            $bplayer->host = $phost ? $phost : null;
            $bplayer->save();
            $i++;
            //TODO: host stuff
        }
        return Redirect::action('MatchController@manage');
    }

    private function fbs($rounds, $id)
    {
        $fbs = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->fb_player_id == $id)
                $fbs++;
            if($round->fb_player_id)
                $noRecs = false;
        }
        return $noRecs ? null : $fbs;
    }

    private function fbWins($rounds, $id, $roster_id)
    {
        $fbWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->fb_player_id == $id && $round->victor_id == $roster_id)
                $fbWins++;
            if($round->fb_player_id && $round->victor_id)
                $noRecs = false;
        }
        return $noRecs ? null : $fbWins;
    }

    private function lms($rounds, $id)
    {
        $lms = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->lms_player_id == $id)
                $lms++;
            if($round->lms)
                $noRecs = false;
        }
        return $noRecs ? null : $lms;
    }

    private function lmsWins($rounds, $id, $roster_id)
    {
        $lmsWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->lms_player_id == $id && $round->victor_id == $roster_id)
                $lmsWins++;
            if($round->lms && $round->victor_id)
                $noRecs = false;
        }
        return $noRecs ? null : $lmsWins;
    }

    //get wins for a particular site (offense or defense)
    private function sideWins($rounds, $roster_id, $side)
    {
        $sideWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            if($round->side_won == $side)
                $sideWins++;
            if($round->side_won)
                $noRecs = false;
        }
        return $noRecs ? null : $sideWins;
    }

    private function sitePlants($rounds, $site, $players) {
        $sitePlants = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            $containsPlanter = containsId($players, $round->planter_id);
            if($containsPlanter && $round->plant_site == $site)
                $sitePlants++;
            if($round->player_id && $round->plant_site)
                $noRecs = false;
        }
        return $noRecs ? null : $sitePlants;
    }

    private function sitePlantWins($rounds, $site, $players, $roster_id) {
        $plantWins = 0;
        $noRecs = true;
        foreach($rounds as $round)
        {
            $containsPlanter = containsId($players, $round->planter_id);
            $isVictor = $round->victor_id == $roster_id;
            $isSite = $round->plant_site == $site;
            if($containsPlanter && $isSite && $isVictor)
                $plantWins++;
            if($round->player_id && $round->plant_site && $round->victor_id)
                $noRecs = false;
        }
        return $noRecs ? null : $plantWins;
    }
}
