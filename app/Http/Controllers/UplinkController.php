<?php
namespace App\Http\Controllers;
use App\Mode;
use App\Map;
use App\MapMode;
use App\Game;
use App\Uplink;
use App\UplinkPlayer;
use App\Match;

use Input;
use Redirect;
use View;

class UplinkController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function update() {
        //TODO: need to remove UplinkPlayers where player was "unselected"
        $match = Match::find(Input::get('match_id'));
        $game = Game::find(Input::get('game_id'));
        $mode = Uplink::find(Input::get('mode_id'));
        $kills = Input::get('kills');
        $deaths = Input::get('deaths');
        $uplinks = Input::get('uplinks');
        $interceptions = Input::get('interceptions');
        $aplayerids = Input::get('aplayers');
        $bplayerids = Input::get('bplayers');
        $aplayers = [];
        //first, set game variables
        //TODO: set mapmode id
        $modeid = $game->mode()->first()->id;
        $mapmode = MapMode::where('map_id', '=', Input::get('map'))->where('mode_id', '=', $modeid)->first();
        $game->map_mode_id = $mapmode->id;
        $game->save();
        //next, set hp variables
        //TODO:set host stuff
        $mode->team_a_score = Input::get('a_score');
        $mode->team_b_score = Input::get('b_score');
        $mode->game_time = Input::get('minutes') * 60 + Input::get('seconds');
        $mode->a_victory = $mode->team_a_score > $mode->team_b_score ? 1 : 0;
        $mode->save();
        //get rid of extra players
        $extras = UplinkPlayer::whereNotIn('player_id', $aplayerids + $bplayerids)->where('uplink_id', '=', $mode->id);
        foreach($extras as $extra)
        {
            dd($extra);
            $extra->delete();
        }

        //set new players
        $i = 0;
        foreach($aplayerids as $aplayerid)
        {
            $aplayer = UplinkPlayer::where('player_id', '=', $aplayerid)->where('uplink_id', '=', $mode->id)->first();
            if(!$aplayer) //if a different player is selected
                $aplayer = new UplinkPlayer;
            $aplayer->player_id = $aplayerid;
            $aplayer->uplink_id = $mode->id;
            $aplayer->kills = $kills[$i];
            $aplayer->deaths = $deaths[$i];
            $aplayer->uplinks = $uplinks[$i];
            $aplayer->interceptions = $interceptions[$i] == "" ? null : $interceptions[$i];
            $aplayer->save();
            $i++;
            //TODO: host stuff
        }

        foreach($bplayerids as $bplayerid)
        {
            $bplayer = UplinkPlayer::where('player_id', '=', $bplayerid)->where('uplink_id', '=', $mode->id)->first();
            if(!$bplayer) //if a different player is selected
                $bplayer = new UplinkPlayer;
            $bplayer->player_id = $bplayerid;
            $bplayer->uplink_id = $mode->id;
            $bplayer->kills = $kills[$i];
            $bplayer->deaths = $deaths[$i];
            $bplayer->uplinks = $uplinks[$i];
            $bplayer->interceptions = $interceptions[$i] == "" ? null : $interceptions[$i];
            $bplayer->save();
            $i++;
            //TODO: host stuff
        }

        return ("<h1>Map Updated</h1>");
        //return Redirect::action('AdminController@dashboard');
        //dd($aplayers);
        //dd($hp);
        //dd($match);
    }
    public function edit($id)
    {
        //id is game id for now (change this later?)
        $game = Game::findOrFail($id);
        $match = $game->match()->first();
        $mode = $game->uplink()->first();
        $gameMode = $game->mode()->first();
        $game->mode = $gameMode;
        $map = $game->map()->first();
        $game->map = $map;
        $maplinks = $gameMode->maplink()->get();
        $maps = [];
        foreach($maplinks as $maplink)
            $maps[] = $maplink->map()->first();

        //all players in the uplink game
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
        return View::make('admin.game.uplink', compact('game', 'match', 'mode', 'maps', 'players', 'aplayers', 'bplayers', 'ascores', 'bscores'));
    }
}
