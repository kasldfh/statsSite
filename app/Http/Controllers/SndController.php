<?php
//TODO: Refactor to only store fb/lms stats in App\SndRound only
namespace App\Http\Controllers;
use App\Mode;
use App\Map;
use App\MapMode;
use App\Game;
use App\Snd;
use App\SndPlayer;
use App\SndRound;
use App\Match;

use Input;
use Redirect;
use View;

class SndController extends Controller {
    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function update() {
        //TODO: need to remove SndPlayers where player was "unselected"
        $match = Match::find(Input::get('match_id'));
        $game = Game::find(Input::get('game_id'));
        $mode = Snd::find(Input::get('mode_id'));
        $kills = Input::get('kills');
        $deaths = Input::get('deaths');
        $plants = Input::get('plants');
        $defuses = Input::get('defuses');
        $defends = Input::get('defends');
        $aplayerids = Input::get('aplayers');
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
        $modeid = $game->mode()->first()->id;
        $mapmode = MapMode::where('map_id', '=', Input::get('map'))->where('mode_id', '=', $modeid)->first();
        $game->map_mode_id = $mapmode->id;
        $game->save();
        //next, set snd variables
        //TODO:set host stuff
        $mode->team_a_score = Input::get('a_score');
        $mode->team_b_score = Input::get('b_score');
        $mode->game_time = Input::get('minutes') * 60 + Input::get('seconds');
        $mode->a_victory = $mode->team_a_score > $mode->team_b_score ? 1 : 0;
        $mode->save();
        //delete old rounds
        SndRound::where('snd_id', '=', $modeid)->delete();
        $rounds = [];
        for($i = 0; $i < $mode->team_a_score + $mode->team_b_score; $i++)
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

    //get rid of extra players
    $extras = SndPlayer::whereNotIn('player_id', $aplayerids + $bplayerids)->where('snd_id', '=', $mode->id);
    foreach($extras as $extra)
    {
        dd($extra);
        $extra->delete();
    }

    //set new players
    $i = 0;
    foreach($aplayerids as $aplayerid)
    {
        $aplayer = SndPlayer::where('player_id', '=', $aplayerid)->where('snd_id', '=', $mode->id)->first();
        if(!$aplayer) //if a different player is selected
            $aplayer = new SndPlayer;
        $aplayer->player_id = $aplayerid;
        $aplayer->snd_id = $mode->id;
        $aplayer->kills = $kills[$i];
        $aplayer->deaths = $deaths[$i];
        $aplayer->plants = $plants[$i];
        $aplayer->defuses = $defuses[$i];
        $aplayer->first_bloods = fbs($rounds, $aplayerid);
        $aplayer->first_blood_wins = fbWins($rounds, $aplayerid, $match->roster_a_id);
        $aplayer->last_man_standing = lms($rounds, $aplayerid);
        $aplayer->last_man_standing_wins = lmsWins($rounds, $aplayerid, $match->roster_a_id);
        $aplayer->save();
        $i++;
        //TODO: host stuff
    }

    foreach($bplayerids as $bplayerid)
    {
        $bplayer = SndPlayer::where('player_id', '=', $bplayerid)->where('snd_id', '=', $mode->id)->first();
        if(!$bplayer) //if a different player is selected
            $bplayer = new SndPlayer;
        $bplayer->player_id = $bplayerid;
        $bplayer->snd_id = $mode->id;
        $bplayer->kills = $kills[$i];
        $bplayer->deaths = $deaths[$i];
        $bplayer->plants = $plants[$i];
        $bplayer->defuses = $defuses[$i];
        $bplayer->first_bloods = fbs($rounds, $bplayerid);
        $bplayer->first_blood_wins = fbWins($rounds, $bplayerid, $match->roster_b_id);
        $bplayer->last_man_standing = lms($rounds, $bplayerid);
        $bplayer->last_man_standing_wins = lmsWins($rounds, $bplayerid, $match->roster_b_id);
        $bplayer->save();
        $i++;
        //TODO: host stuff
    }

    return ("<h1>Map Updated</h1>");
    //return Redirect::action('AdminController@dashboard');
    //dd($aplayers);
    //dd($snd);
    //dd($match);
}

public function create() {
    $input = Input::all();
    dd($input);
    
}
public function edit($id)
{
    //id is game id for now (change this later?)
    $game = Game::findOrFail($id);
    $match = $game->match()->first();
    $mode = $game->snd()->first();
    $gameMode = $game->mode()->first();
    $game->mode = $gameMode;
    $map = $game->map()->first();
    $game->map = $map;
    $maplinks = $gameMode->maplink()->get();
    $maps = [];
    foreach($maplinks as $maplink)
        $maps[] = $maplink->map()->first();

    //all players in the snd game
    $players = $mode->players()->get();
    //lists of all players per roster
    $aplayers = $match->rostera()->first()->playermap()->get();
    $bplayers = $match->rosterb()->first()->playermap()->get();
    //generate list of players by roster
    $ascores = [];
    foreach($players as $player)
        foreach($aplayers as $aplayer)
            if($player->player_id == $aplayer->player->id)
            {
                $player->alias = $aplayer->player->alias;
                $ascores[] = $player;
            }
    $bscores = [];
    foreach($players as $player)
        foreach($bplayers as $bplayer)
            if($player->player_id == $bplayer->player->id)
            {
                $player->alias = $bplayer->player->alias;
                $bscores[] = $player;
            }

    //dd($ascores);
    //dd($aplayers);
    return View::make('admin.game.snd', compact('game', 'match', 'mode', 'maps', 'players', 'aplayers', 'bplayers', 'ascores', 'bscores'));
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

private function containsId($players, $id)
{
    foreach($players as $player)
        if($player->player_id == $id)
            return true;
    return false;
}
}

