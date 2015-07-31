<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Match;
use App\Mode;
use App\Map;
use App\MapMode;
use App\Game;
use App\Ctf;
use App\Hp;
use App\Snd;
use App\Uplink;
use App\CtfPlayer;
use App\UplinkPlayer;
use App\HpPlayer;
use App\SndPlayer;
use App\SndRound;

use Input;
use Redirect;
use View;

class GameController extends Controller {

    public function __construct() {
        $this->beforeFilter('auth');
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
        //placeholder
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
        if($game->hp())
            $mode = $game->hp()->first();
        else if ($game->ctf())
            $mode = $game->ctf()->first();
        else if($game->uplink())
            $mode = $game->uplink()->first();
        else if($game->snd())
            $mode = $game->snd()->first();
        else
            dd("wtf");
        return View::make('admin.game.edit', compact('game', 'mode', 'match', 'modes', 'maps', 'mode_map'));
    }


    public function store() {
        //DBug::DBug(Input::all(), true);
        $mode = Input::get('mode');
        if($mode == 4) {
            return $this->createSnd();
        }

        $match = Match::find(Input::get('match_id'));
        $host = Input::get('host');
        $pHost = Input::get('p_host');
        $roster_a = $match->rostera->id;
        $roster_b = $match->rosterb->id;
        $map = Input::get('map');
        $mode = Input::get('mode');
        $map_mode = MapMode::where('map_id', $map)->where('mode_id', $mode)->first();
        $game = new Game;
        $game->match_id = $match->id;
        $game->game_number = count(Game::where('match_id', $match->id)->get()) + 1;
        $game->map_mode_id = $map_mode->id;
        $game->save();
        if($mode == 4) {
            $snd = new Snd;
            $scores = Input::get('team');
            $side = Input::get('side');
            $fb = Input::get('fb');
            $planter = Input::get('planter');
            $site = Input::get('site');
            $a_score = 0;
            $b_score = 0;
            $a_offense = 0;
            $b_offense = 0;
            $a_defense = 0;
            $b_defense = 0;
            $a_a = 0;
            $a_b = 0;
            $a_a_win = 0;
            $a_b_win = 0;
            $b_a = 0;
            $b_b = 0;
            $b_a_win = 0;
            $b_b_win = 0;
            $i = 0;
            $fb_wins = [[]];
            while($scores[$i] != "") {
                if($planter[$i] != "") {
                    if($planter[$i] == $roster_a){
                        if($site[$i] == 'a') {
                            $a_a++;
                            if($scores[$i] == $roster_a) {
                                $a_a_win++;
                            }
                        } else {
                            $a_b++;
                            if($scores[$i] == $roster_a) {
                                $a_b_win++;
                            }
                        }
                    } else {
                        if($site[$i] == 'a') {
                            $b_a++;
                            if($scores[$i] == $roster_b) {
                                $b_a_win++;
                            }
                        } else {
                            $b_b++;
                            if($scores[$i] == $roster_b) {
                                $b_b_win++;
                            }
                        }
                    }
                }
                if($scores[$i] == $roster_a){
                    if(!isset($fb_wins[$fb[$i]])){
                        $fb_wins[$fb[$i]] = 0;
                    }
                    if(array_key_exists($fb[$i], $match->rostera->players)) {
                        $fb_wins[$fb[$i]] += 1;
                    }
                    $a_score++;
                    if($side[$i] == 'o') {
                        $a_offense++;
                    } else {
                        $a_defense++;
                    }
                } else {
                    if(!isset($fb_wins[$fb[$i]])){
                        $fb_wins[$fb[$i]] = 0;
                    }
                    if(array_key_exists($fb[$i], $match->rosterb->players)) {
                        $fb_wins[$fb[$i]] += 1;
                    }
                    $b_score++;
                    if($side[$i] == 'o') {
                        $b_offense++;
                    } else {
                        $b_defense++;
                    }
                }
                $i++;
            }

            $snd->game_id = $game->id;
            if(!is_null($host)) {
                $snd->team_a_host = $host == 'a';
            }
            $snd->team_a_score = Input::get('a_snd_score', 0);
            $snd->team_b_score = Input::get('b_snd_score', 0);
            $snd->a_offense_wins = $a_offense;
            $snd->a_defense_wins = $a_defense;
            $snd->b_offense_wins = $b_offense;
            $snd->b_defense_wins = $b_defense;
            $snd->a_plant_a = $a_a;
            $snd->a_plant_b = $a_b;
            $snd->a_plant_a_win = $a_a_win;
            $snd->a_plant_b_win = $a_b_win;
            $snd->b_plant_a = $b_a;
            $snd->b_plant_b = $b_b;
            $snd->b_plant_a_win = $b_a_win;
            $snd->b_plant_b_win = $b_b_win;
            $snd->game_time = Input::get('game_time');
            $snd->save();
            if(Input::get('a_snd_score', 0) > Input::get('b_snd_score', 0)) {
                $match->a_map_count++;
            } else {
                $match->b_map_count++;
            }
            $match->save();
            $players = Input::get('snd_player');
            //DBug::DBug($fb_wins, true);
            $plants = Input::get('plants');
            $snd_kills = Input::get('snd_kills');
            $snd_deaths = Input::get('snd_deaths');
            $defuses = Input::get('defuses');
            $fb_count = array_count_values($fb);
            foreach ($players as $i => $player) {
                $snd_player = new SndPlayer;
                $snd_player->snd_id = $snd->id;
                $snd_player->player_id = $player;
                if(isset($fb_count[$player])){
                    $snd_player->first_bloods = $fb_count[$player];
                    if(isset($fb_wins[$player])) {
                        $snd_player->first_blood_wins = $fb_wins[$player];
                    } else {
                        $snd_player->first_blood_wins = 0;
                    }
                } else {
                    $snd_player->first_bloods = 0;
                    $snd_player->first_blood_wins = 0;
                }

                $snd_player->plants = $plants[$i];
                $snd_player->kills = $snd_kills[$i];
                $snd_player->deaths = $snd_deaths[$i];
                $snd_player->defuse = $defuses[$i];
                $snd_player->host = $pHost == $player;
                $snd_player->save();
            }
        } elseif($mode == 2) {
            $ctf = new Ctf;
            $ctf->game_id = $game->id;
            if(!is_null($host)) {
                $ctf->team_a_host = $host == 'a';
            }
            $ctf->team_a_score = Input::get('a_ctf_score');
            $ctf->team_b_score = Input::get('b_ctf_score');
            $ctf->game_time = Input::get('game_time');
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
        } elseif($mode == 4) {
            $uplink = new Uplink;
            $uplink->game_id = $game->id;
            if(!is_null($host)) {
                $uplink->team_a_host = $host == 'a';
            }
            $uplink->team_a_score = Input::get('a_uplink_score');
            $uplink->team_b_score = Input::get('b_uplink_score');
            $uplink->game_time = Input::get('game_time');
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
        } elseif($mode == 5) {
            $hp = new Hp;
            if(!is_null($host)) {
                $hp->team_a_host = $host == 'a';
            }
            $hp->game_id = $game->id;
            $hp->team_a_score = Input::get('a_hp_score');
            $hp->team_b_score = Input::get('b_hp_score');
            $hp->game_time = Input::get('game_time');
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
            $captures = Input::get('hp_captures');
            $defends = Input::get('hp_defends');
            foreach ($players as $i => $player) {
                $hp_player = new HpPlayer;
                $hp_player->hp_id = $hp->id;
                $hp_player->player_id = $player;
                $hp_player->kills = $hp_kills[$i];
                $hp_player->deaths = $hp_deaths[$i];
                $hp_player->captures = $captures[$i];
                $hp_player->defends = $defends[$i];
                $hp_player->host = $pHost == $player;
                $hp_player->save();
            }
        }

        return Redirect::action('MatchController@manage');
    }

    public function delete($id) {
        Game::destroy($id);
        return Redirect::action('GameController@manage');
    }
    public function createSnd() {
        //TODO: need to remove SndPlayers where player was "unselected"
        //dd(Input::all());
        $match = Match::find(Input::get('match_id'));

        $game = new Game;
        $game->match_id = $match->id;
        $game->game_number = count(Game::where('match_id', $match->id)->get()) + 1;

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
        $sites = input::get('plant');
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
        $mode->save();

        $rounds = [];
        for($i = 0; $i < $mode->team_a_score + $mode->team_b_score -1; $i++)
        {
            $round = new SndRound;
            $round->snd_id = $modeid;
            $round->round_number = $i+1;
            $round->side_won = $sides[$i];
            $round->victor_id = $victors[$i];
            $round->fb_player_id = $fbs[$i];
            $round->lms_player_id = $lms[$i];
            $round->planter_id = $planters[$i];
            $round->plant_site = $sites[$i];
            $round->save();
            $rounds[] = $round;
        }
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
            $bplayer->save();
            $i++;
            //TODO: host stuff
        }
        return "<h1>Snd Map Stored</h1>";
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
