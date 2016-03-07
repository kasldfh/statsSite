<?php
//TODO: Refactor to only store fb/lms stats in App\SndRound only
namespace App\Http\Controllers;

use App\Models\Mode;
use App\Models\Map;
use App\Models\MapMode;
use App\Models\Game;
use App\Models\Snd;
use App\Models\SndPlayer;
use App\Models\SndRound;
use App\Models\Match;
use App\Models\Pick;

use Input;
use Redirect;
use View;

class SndController extends BaseModeAdminController {
    public function __construct() {
        $this->middleware('auth');
    }

    public function update() {
        //TODO: need to remove SndPlayers where player was "unselected"
        $match = Match::find(Input::get('match_id'));
        $game = Game::find(Input::get('game_id'));
        $scoreTypeId = Input::get('score_type_id');
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
        $sites = input::get('site');
        $planters = Input::get('planter');
        $lms = Input::get('lms');
        $victors = Input::get('victor');
        $aplayers = [];
        //first, set game variables
        $modeid = $game->mode()->first()->id;
        $mapmode = MapMode::where('map_id', '=', Input::get('map'))->where('mode_id', '=', $modeid)->first();
        $game->map_mode_id = $mapmode->id;
        $game->score_type_id = $scoreTypeId;
        $game->save();
        //next, set snd variables
        //TODO:set host stuff
        $mode->team_a_score = Input::get('a_score');
        $mode->team_b_score = Input::get('b_score');
        $mode->game_time = Input::get('minutes') * 60 + Input::get('seconds');
        $mode->a_victory = $mode->team_a_score > $mode->team_b_score ? 1 : 0;
        $mode->save();
        //delete old rounds
        SndRound::where('snd_id', $mode->id)->delete();
        $rounds = [];
        for($i = 0; $i < $mode->team_a_score + $mode->team_b_score; $i++)
        {
            $round = new SndRound;
            $round->snd_id = $mode->id;
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
            $aplayer->first_bloods = parent::fbs($rounds, $aplayerid);
            $aplayer->first_blood_wins = parent::fbWins($rounds, $aplayerid, $match->roster_a_id);
            $aplayer->last_man_standing = parent::lms($rounds, $aplayerid);
            $aplayer->last_man_standing_wins = parent::lmsWins($rounds, $aplayerid, $match->roster_a_id);
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
            $bplayer->first_bloods = parent::fbs($rounds, $bplayerid);
            $bplayer->first_blood_wins = parent::fbWins($rounds, $bplayerid, $match->roster_b_id);
            $bplayer->last_man_standing = parent::lms($rounds, $bplayerid);
            $bplayer->last_man_standing_wins = parent::lmsWins($rounds, $bplayerid, $match->roster_b_id);
            $bplayer->save();
            $i++;
            //TODO: host stuff
        }

        //update picks
        parent::update_picks($game->id);
        //update specialists
        parent::update_specialist($game->id);

        //start process to refill cache for this event
        parent::refresh_cache($match->event_id);

        return Redirect::action('AdminController@dashboard');
    }

    public function edit($id) {
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

        //rounds
        $rounds = SndRound::where('snd_id', '=', $mode->id)->get();

        //all players in the snd game
        $players = $mode->players()->get();
        //lists of all players per roster
        $aplayers = $match->rostera()->first()->playermap()->get();
        $bplayers = $match->rosterb()->first()->playermap()->get();
        foreach($aplayers as $aplayer) {
            $aplayerarr[$aplayer->player->id] = $aplayer->player->alias;
        }
        foreach($bplayers as $bplayer) {
            $bplayerarr[$bplayer->player->id] = $bplayer->player->alias;
        }
        //generate list of players by roster
        $ascores = [];
        foreach($players as $player)
            foreach($aplayers as $aplayer)
                if($player->player_id == $aplayer->player->id)
                {
                    $player->alias = $aplayer->player->alias;
                    if($player->host)
                        $mode->pHost = $player->player_id;
                    $ascores[] = $player;
                }
        $bscores = [];
        foreach($players as $player)
            foreach($bplayers as $bplayer)
                if($player->player_id == $bplayer->player->id)
                {
                    $player->alias = $bplayer->player->alias;
                    if($player->host)
                        $mode->pHost = $player->player_id;
                    $bscores[] = $player;
                }

        $items = parent::get_pick_items($match->event_id);
        $picks = Pick::where('game_id', $game->id)->orderBy('number')->get();
        $specialist_players = parent::get_specialist_players($game->id);
        $specialists = parent::get_specialists($match->event_id);

        return View::make('admin.game.snd', compact('game', 'match', 'mode',
            'maps', 'players', 'aplayers', 'bplayers', 'ascores', 'bscores',
            'rounds', 'aplayerarr', 'bplayerarr', 'picks', 'items',
            'specialist_players', 'specialists'));
    }
}

