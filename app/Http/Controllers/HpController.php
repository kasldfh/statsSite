<?php
namespace App\Http\Controllers;
use App\Mode;
use App\Map;
use App\MapMode;
use App\Game;
use App\Hp;
use App\HpPlayer;
use App\Match;

use Input;
use Redirect;
use View;

class HpController extends Controller {
    public function __construct() {
        $this->beforeFilter('auth');
    }
    public function update() {
        //TODO: need to remove HpPlayers where player was "unselected"
        $match = Match::find(Input::get('match_id'));
        $game = Game::find(Input::get('game_id'));
        $hp = Hp::find(Input::get('mode_id'));
        $kills = Input::get('hp_kills');
        $deaths = Input::get('hp_deaths');
        $captures = Input::get('hp_captures');
        $defends = Input::get('hp_defends');
        $aplayerids = Input::get('aplayers');
        $bplayerids = Input::get('bplayers');
        $aplayers = [];
        //first, set game variables
        //TODO: set mapmode id
        //next, set hp variables
        //TODO:set host stuff
        $hp->team_a_score = Input::get('a_hp_score');
        $hp->team_b_score = Input::get('b_hp_score');
        $hp->game_time = Input::get('minutes') * 60 + Input::get('seconds');
        $hp->a_victory = $hp->team_a_score > $hp->team_b_score ? 1 : 0;
        $hp->save();
        //get rid of extra players
        $extras = HpPlayer::whereNotIn('player_id', $aplayerids + $bplayerids)->where('hp_id', '=', $hp->id);
        foreach($extras as $extra)
        {
            dd($extra);
            $extra->delete();
        }

        //set new players
        $i = 0;
        foreach($aplayerids as $aplayerid)
        {
            $aplayer = HpPlayer::where('player_id', '=', $aplayerid)->where('hp_id', '=', $hp->id)->first();
            if(!$aplayer) //if a different player is selected
                $aplayer = new HpPlayer;
            $aplayer->player_id = $aplayerid;
            $aplayer->hp_id = $hp->id;
            $aplayer->kills = $kills[$i];
            $aplayer->deaths = $deaths[$i];
            $aplayer->captures = $captures[$i];
            $aplayer->defends = $defends[$i];
            $aplayer->save();
            $i++;
            //TODO: host stuff
        }

        foreach($bplayerids as $bplayerid)
        {
            $bplayer = HpPlayer::where('player_id', '=', $aplayerid)->where('hp_id', '=', $hp->id)->first();
            if(!$bplayer) //if a different player is selected
                $bplayer = new HpPlayer;
            $bplayer->player_id = $bplayerid;
            $bplayer->hp_id = $hp->id;
            $bplayer->kills = $kills[$i];
            $bplayer->deaths = $deaths[$i];
            $bplayer->captures = $captures[$i];
            $bplayer->defends = $defends[$i];
            $bplayer->save();
            $i++;
            //TODO: host stuff
        }

        //dd($aplayers);
        //dd($hp);
        //dd($match);
    }
    public function edit($id)
    {
        //id is game id for now (change this later?)
        $game = Game::findOrFail($id);
        $match = $game->match()->first();
        $hp = $game->hp()->first();
        $mode = $game->mode()->first();
        $game->mode = $mode;
        $map = $game->map()->first();
        $game->map = $map;
        $maplinks = $mode->maplink()->get();
        $maps = [];
        foreach($maplinks as $maplink)
            $maps[] = $maplink->map()->first();

        //all players in the hp game
        $players = $hp->players()->get();
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

        dd($ascores);
        //dd($aplayers);
        return View::make('admin.game.hp', compact('game', 'match', 'hp', 'maps', 'players', 'aplayers', 'bplayers', 'ascores', 'bscores'));
    }
}
