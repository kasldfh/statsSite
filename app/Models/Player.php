<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ctf;
use App\Models\CtfPlayer;
use App\Models\Match;
class Player extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'player';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    //protected $appends = ['kd'];
    //protected $hidden = ['kd'];

	public function rostermap() {
		return $this->hasMany('App\Models\PlayerRoster', 'player_id', 'id')->orderBy('id', 'desc');
	}

	//public function getKdAttribute() {
    //    $kdarr = ['kills' => 0, 'deaths' => 0];
    //    $calculate=function(&$kdarr, $mode) {
    //        foreach($mode as $mode_game) {
    //            $kdarr['kills'] += $mode_game->kills;
    //            $kdarr['deaths'] += $mode_game->deaths;
    //        }
    //    };
    //    $calculate($kdarr, SndPlayer::where('player_id', $this->id)->get());
    //    $calculate($kdarr, UplinkPlayer::where('player_id', $this->id)->get());
    //    $calculate($kdarr, CtfPlayer::where('player_id', $this->id)->get());
    //    $calculate($kdarr, HpPlayer::where('player_id', $this->id)->get());

    //    $kd = $kdarr['kills'];
    //    if($kdarr['deaths'] != 0) {
    //        $kd = round($kdarr['kills'] / $kdarr['deaths'], 2);
    //    }
    //    return $kd;
	//}

	public function kdByEvent($id) {
		$matches = Event::find($id)->matches;
        $kdarr = ['kills' => 0, 'deaths' => 0];
		foreach ($matches as $match) {
			$games = $match->games;
			foreach ($games as $game) {
                $this->kdCalculator($kdarr, $game->ctf);
                $this->kdCalculator($kdarr, $game->snd);
                $this->kdCalculator($kdarr, $game->hp);
                $this->kdCalculator($kdarr, $game->uplink);
            }
		}
        $kd = $kdarr['kills'];
        if($kdarr['deaths'] != 0) {
            $kd = round($kdarr['kills'] / $kdarr['deaths'], 2);
        }
        return $kd;
	}

	public function getMapCountByEvent($id) {
        $maps = 0;
        $maps += $this->getSndMapCountByEvent($id);
        $maps += $this->getCtfMapCountByEvent($id);
        $maps += $this->getHpMapCountByEvent($id);
        $maps += $this->getUplinkMapCountByEvent($id);
        return $maps;
        
	}

	public function getRespawnMapCountByEvent($id) {
        $maps = 0;
        $maps += $this->getCtfMapCountByEvent($id);
        $maps += $this->getHpMapCountByEvent($id);
        $maps += $this->getUplinkMapCountByEvent($id);
        return $maps;
	}
	
    public function getHpMapCountByEvent($event_id) {
        //get snd maps from specified event only
        $hps = Hp::with([
            'players' => function($query) {
                $query->where('player_id', $this->id);
            }, 
            'game.match' => function($query) use ($event_id) {
                $query->where('event_id', $event_id);
            }])->get();
        return count($hps);
    }

    public function getCtfMapCountByEvent($event_id) {
        //get snd maps from specified event only
        $ctfs = Ctf::with([
            'players' => function($query) {
                $query->where('player_id', $this->id);
            }, 
            'game.match' => function($query) use ($event_id) {
                $query->where('event_id', $event_id);
            }])->get();
        return count($ctfs);
    }

    public function getUplinkMapCountByEvent($event_id) {
        //get snd maps from specified event only
        $uplinks = Uplink::with([
            'players' => function($query) {
                $query->where('player_id', $this->id);
            }, 
            'game.match' => function($query) use ($event_id) {
                $query->where('event_id', $event_id);
            }])->get();
        return count($uplinks);
    }

	public function getSndMapCountByEvent($id) {
        //get snd maps from specified event only
        $snds = Snd::with([
            'players' => function($query) {
                $query->where('player_id', $this->id);
            }, 
            'game.match' => function($query) use ($id) {
                $query->where('event_id', $id);
            }])->get();
        return count($snds);
    }
    public function getSndkdByEvent($id) {
        //$matches = Event::find($id)->matches;
        $matches = Event::find($id)->matches;
        $kills = 0;
        $deaths = 0;
        foreach ($matches as $match) {
            $games = $match->games;
            foreach ($games as $game) {
                $snd = $game->snd;
                if($snd) {
                    foreach ($snd->players as $player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $deaths += $player->deaths;
                        }
                    }
                }
            }
        }
        return $deaths != 0 ? round(($kills / $deaths), 2) : 0;
    }


    public function getHpkdByEvent($id) {
        //$matches = Event::find($id)->matches;
        $matches = Event::find($id)->matches;
        $kills = 0;
        $deaths = 0;
        foreach ($matches as $match) {
            $games = $match->games;
            foreach ($games as $game) {
                $hp = $game->hp;
                if($hp) {
                    foreach ($hp->players as $player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $deaths += $player->deaths;
                        }
                    }
                }
            }
        }
        return $deaths != 0 ? round(($kills / $deaths), 2) : 0;
    }

    public function getUplinkkdByEvent($id) {
        //$matches = Event::find($id)->matches;
        $matches = Event::find($id)->matches;
        $kills = 0;
        $deaths = 0;
        foreach ($matches as $match) {
            $games = $match->games;
            foreach ($games as $game) {
                $uplink = $game->uplink;
                if($uplink) {
                    foreach ($uplink->players as $player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $deaths += $player->deaths;
                        }
                    }
                }
            }
        }
        return $deaths != 0 ? round(($kills / $deaths), 2) : 0;
    }


    public function getCtfkdByEvent($id) {
        //$matches = Event::find($id)->matches;
        $matches = Event::find($id)->matches;
        $kills = 0;
        $deaths = 0;
        foreach ($matches as $match) {
            $games = $match->games;
            foreach ($games as $game) {
                $ctf = $game->ctf;
                if($ctf) {
                    foreach ($ctf->players as $player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $deaths += $player->deaths;
                        }
                    }
                }
            }
        }
        return $deaths != 0 ? round(($kills / $deaths), 2) : 0;
    }


    public function getSlayerByEvent($event_id) {
        $matches = Event::find($event_id)->matches;
        $kills = 0;
        $maps = 0;
        foreach ($matches as $match) {
            $games = $match->games;
            foreach ($games as $game) {
                //respawn modes only
                $ctf = $game->ctf;
                $hp = $game->hp;
                $uplink = $game->uplink;
                if($ctf){
                    foreach ($ctf->players as $player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $maps++;
                        }
                    }
                }
                if($hp) {
                    foreach ($hp->players as $player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $maps++;
                        }
                    }
                }
                if($uplink) {
                    foreach ($uplink->players as $this->player) {
                        if($player->player_id == $this->id) {
                            $kills += $player->kills;
                            $maps++;
                        }
                    }
                }
            }
        }
        return ($maps != 0) ? round(($kills / $maps) * 600, 2) : 0;
    }

    public function getMapCount() {
        $snd_games = SndPlayer::where("player_id", $this->id)->get();
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();
        $hp_games = HpPlayer::where("player_id", $this->id)->get();

        $total = count($ctf_games) + count($uplink_games) + count($hp_games) + count($snd_games);

        return $total; 
    }

    public function getSlayerMapCount() {
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();
        $hp_games = HpPlayer::where("player_id", $this->id)->get();

        $total = count($ctf_games) + count($uplink_games) + count($hp_games);

        return $total; 
    }

    public function getSnDMapCount() {
        $snd_games = SndPlayer::where("player_id", $this->id)->get();

        $total = count($snd_games);

        return $total; 
    }

    public function getSndkdAttribute() {
        $kills = 0;
        $deaths = 0;
        $snd_games = SndPlayer::where("player_id", $this->id)->get();
        foreach ($snd_games as $game) {	
            $kills += $game->kills;
            $deaths += $game->deaths;
        }
        return ($deaths != 0) ? round($kills / $deaths, 2) : 0;
    }

    public function getSlayerAttribute() {
        $kills = 0;
        $game_time = 0;
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();
        foreach ($ctf_games as $game) {
            $kills += $game->kills;
            $ctfgame = $game->game;
            $game_time += $ctfgame->game_time;
            $game_time += $game->game->game_time;
        }
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();
        foreach ($uplink_games as $game) {
            $kills += $game->kills;
            $game_time += $game->game->game_time;
        }
        $hp_games = HpPlayer::where("player_id", $this->id)->get();
        foreach ($hp_games as $game) {
            $kills += $game->kills;
            $game_time += $game->game->game_time;
        }
        return ($game_time != 0) ? round(($kills / $game_time) * 600, 2) : 0;
    }

    public function getCTFCapsTotal() {
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();
        $ctf_captures = 0;
        foreach ($ctf_games as $game) {
            $ctf_captures += $game->captures;
        }

        return $ctf_captures;
    }

    public function getCTFCapsAverage() {
        return ($this->getCTFMapCount() != 0) ? number_format((float)$this->getCTFCapsTotal()/ $this->getCTFMapCount(), 2, '.', '') : 0;
    }

    public function getCTFKD() {
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();
        $kills = 0;
        $deaths = 0;

        foreach ($ctf_games as $game) {
            $kills += $game->kills;
            $deaths += $game->deaths;
        }

        return ($deaths != 0) ? number_format((float)$kills / $deaths, 2, '.', '') : 0;
    }

    public function getCTFMapCount() {
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();

        return count($ctf_games);
    }

    public function getUplinkTotal() {
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();
        $uplinks = 0;
        foreach ($uplink_games as $game) {
            $uplinks += $game->uplinks;
        }

        return $uplinks;
    }

    public function getUplinkAverage() {
        return ($this->getUplinkMapCount() != 0) ? number_format((float)$this->getUplinkTotal()/ $this->getUplinkMapCount(), 2, '.', '') : 0;

    }

    public function getUplinkKD() {
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();
        $kills = 0;
        $deaths = 0;

        foreach ($uplink_games as $game) {
            $kills += $game->kills;
            $deaths += $game->deaths;
        }

        return ($deaths != 0) ? number_format((float)$kills / $deaths, 2, '.', '') : 0;
    }

    public function getUplinkMapCount() {
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();

        return count($uplink_games);
    }

    public function getRespawnAttribute() {
        $kills = 0;
        $ctf_defends = 0;
        $hp_defends = 0;
        $hp_captures = 0;
        $ctf_returns = 0;
        $ctf_captures = 0;
        $uplinks = 0;
        $deaths = 0;
        $neg_maps = 0;
        $game_time = 0;
        $ctf_games = CtfPlayer::where("player_id", $this->id)->get();
        foreach ($ctf_games as $game) {
            $kills += $game->kills;
            if($game->deaths > $game->kills) {
                $neg_maps += 1;
            }
            $ctf_returns += $game->returns;
            $ctf_captures += $game->captures;
            $ctf_defends += $game->defends;
            $deaths += $game->deaths;
            $game_time += $game->game->game_time;
        }
        $uplink_games = UplinkPlayer::where("player_id", $this->id)->get();
        foreach ($uplink_games as $game) {
            $kills += $game->kills;
            if($game->deaths > $game->kills) {
                $neg_maps += 1;
            }
            $uplinks += $game->uplinks;
            $deaths += $game->deaths;
            $game_time += $game->game->game_time;
        }
        $hp_games = HpPlayer::where("player_id", $this->id)->get();
        foreach ($hp_games as $game) {
            $kills += $game->kills;
            if($game->deaths > $game->kills) {
                $neg_maps += 1;
            }
            $hp_defends += $game->defends;
            $hp_captures += $game->captures;
            $deaths += $game->deaths;
            $game_time += $game->game->game_time;
        }
        $respawn = 0;
        if($game_time != 0) {
            $respawn = ($kills + $ctf_defends + (3 * $hp_defends) + (1.5 * $hp_captures) + (1.5 * $ctf_returns) + (4 * $ctf_captures) + (3 * $uplinks) - $deaths - (1.5 * $neg_maps)) / ($game_time / 60);
        }
        return $respawn != 0 ? round($respawn, 2) : 0;
    }

    public function getFbAttribute() {
        $roster = $this->rostermap;
        if(count($roster) > 0) {
            $roster = $roster[0]->roster->playermap;
            $total = 0;
            $player_total = 0;
            foreach ($roster as $player) {
                $snd_games = SndPlayer::where('player_id', $player->player->id)->get();
                foreach ($snd_games as $game) {
                    $total += $game->first_bloods;
                }
                if($this->id == $player->player->id) {
                    foreach ($snd_games as $game) {
                        $player_total += $game->first_bloods;
                    }
                }
            }
            return $total != 0 ? round(($player_total / $total) * 100, 2) : 0;
        } else {
            return 0;
        }
    }

    public function getPlantAttribute(){
        $roster = $this->rostermap;
        if(count($roster) > 0) {
            $roster = $roster[0]->roster->playermap;
            $total = 0;
            $player_total = 0;
            foreach ($roster as $player) {
                $snd_games = SndPlayer::where('player_id', $player->player->id)->get();
                foreach ($snd_games as $game) {
                    $total += $game->plants;
                }
                if($this->id == $player->player->id) {
                    foreach ($snd_games as $game) {
                        $player_total += $game->plants;
                    }
                }
            }
            return $total != 0 ? round(($player_total / $total) * 100, 2) : 0;
        } else {
            return 0;
        }
    }

    private function kdCalculator(&$kdarr, $mode_game) {
        if(!$mode_game) {
            return $kdarr;
        }

        foreach ($mode_game->players as $player) {
            if($player->player_id == $this->id) {
                $kdarr['kills'] += $player->kills;
                $kdarr['deaths'] += $player->deaths;
            }
        }
    }
}
