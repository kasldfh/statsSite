<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Match;
use App\Game;
use App\Player;

use Input;
use Carbon\Carbon;

class PlayerScoreController extends BaseController {
    public function playerScores() {
        $hours_delay = Input::get('hours_delay');
        $hours_delay = $hours_delay ? $hours_delay : 12;
        $event_id = Input::get('event_id');

        $cached = parent::cacheGet('stat:playerscores:'.$hours_delay);
        if($cached)
            $cached = json_decode($cached);
        if(!$cached)
        {
            $matches = Match::where('event_id', '=', $event_id)->where('created_at', '>', Carbon::now()->subHours($hours_delay))->get();
            $scores = [];
            $maps = [];
            foreach($matches as $match) {
                $games = Game::where('match_id', '=', $match->id)->get();
                foreach($games as $game)
                {
                    if($game->hp()->first())
                    {
                        $mode = $game->hp()->first();
                        foreach($mode->players()->get() as $hpPlayer)
                        {
                            $player = $hpPlayer->player()->first();
                            if(!array_key_exists($player->alias, $scores))
                                $scores[$player->alias] = 0;
                            $scores[$player->alias] += $hpPlayer->kills;
                            $scores[$player->alias] -= $hpPlayer->deaths *.6; 
                            $scores[$player->alias] += $hpPlayer->captures;
                            $scores[$player->alias] += $hpPlayer->defends * .5;
                            if(!array_key_exists($player->alias, $maps))
                                $maps[$player->alias] = 0;
                            $maps[$player->alias]++;
                        }
                    }
                    else if($game->uplink()->first())
                    {
                        $mode = $game->uplink()->first();
                        foreach($mode->players()->get() as $uplinkPlayer)
                        {
                            $player = $uplinkPlayer->player()->first();
                            if(!array_key_exists($player->alias, $scores))
                                $scores[$player->alias] = 0;
                            $scores[$player->alias] += $uplinkPlayer->kills * 1.1;
                            $scores[$player->alias] -= $uplinkPlayer->deaths *.8; 
                            $scores[$player->alias] += $uplinkPlayer->uplinks * 3;
                            if(!array_key_exists($player->alias, $maps))
                                $maps[$player->alias] = 0;
                            $maps[$player->alias]++;
                        }
                    }
                    else if($game->snd()->first())
                    {
                        $mode = $game->snd()->first();
                        foreach($mode->players()->get() as $sndPlayer)
                        {
                            $player = $sndPlayer->player()->first();
                            if(!array_key_exists($player->alias, $scores))
                                $scores[$player->alias] = 0;
                            $scores[$player->alias] += $sndPlayer->kills * 2;
                            $scores[$player->alias] -= $sndPlayer->deaths *1.2; 
                            $scores[$player->alias] += $sndPlayer->plants * 3;
                            if(!array_key_exists($player->alias, $maps))
                                $maps[$player->alias] = 0;
                            $maps[$player->alias]++;
                        }
                    }
                }
            }
            //divide by maps played
            foreach($scores as $alias => $score)
            {
                $scores[$alias] /= $maps[$alias];
            }
            parent::cache('stat:playerscores:'.$hours_delay, json_encode($scores));
            $cached = $scores;
        }
        //yolo who needs a view
        print("<h1>Fantasy Scores</h1>");
        print('<table><thead><tr><th>Player</th><th>Score</th></tr></thead>');
        print('<tbody>');
        foreach($cached as $player => $score)
            print('<tr><td>' . $player . '</td><td>' . $score . '</td></tr>');
        print('</tbody></table');
    }
}
