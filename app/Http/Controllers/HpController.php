<?php
namespace App\Http\Controllers;
use App\Mode;
use App\Map;
use App\MapMode;
use App\Game;
use App\Hp;

use Input;
use Redirect;
use View;

class HpController extends Controller {
    public function __construct() {
        $this->beforeFilter('auth');
    }
    public function update() {

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

        //dd($ascores);
        //dd($aplayers);
        return View::make('admin.game.hp', compact('game', 'match', 'hp', 'maps', 'players', 'aplayers', 'bplayers', 'ascores', 'bscores'));
    }
}
