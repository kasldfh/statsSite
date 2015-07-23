<?php
namespace App\Http\Controllers;
use App\Mode;
use App\Map;
use App\MapMode;
use App\Game;
use App\Snd;
use App\SndPlayer;
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
        $captures = Input::get('captures');
        $returns = Input::get('returns');
        $defends = Input::get('defends');
        $aplayerids = Input::get('aplayers');
        $bplayerids = Input::get('bplayers');
        $aplayers = [];
        //first, set game variables
        //TODO: set mapmode id
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
            $aplayer->captures = $captures[$i];
            $aplayer->defends = $defends[$i];
            $aplayer->returns = $returns[$i];
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
            $bplayer->captures = $captures[$i];
            $bplayer->defends = $defends[$i];
            $bplayer->returns = $returns[$i];
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
}

