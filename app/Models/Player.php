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
    
    public function getSndkdByEvent($id) {
		$matches = Event::find($id)->matches;
        $kdarr = ['kills' => 0, 'deaths' => 0];
		foreach ($matches as $match) {
			$games = $match->games;
			foreach ($games as $game) {
                $this->kdCalculator($kdarr, $game->snd);
            }
		}
        $kd = $kdarr['kills'];
        if($kdarr['deaths'] != 0) {
            $kd = round($kdarr['kills'] / $kdarr['deaths'], 2);
        }
        return $kd;
	}

    public function getHpkdByEvent($id) {
		$matches = Event::find($id)->matches;
        $kdarr = ['kills' => 0, 'deaths' => 0];
		foreach ($matches as $match) {
			$games = $match->games;
			foreach ($games as $game) {
                $this->kdCalculator($kdarr, $game->hp);
            }
		}
        $kd = $kdarr['kills'];
        if($kdarr['deaths'] != 0) {
            $kd = round($kdarr['kills'] / $kdarr['deaths'], 2);
        }
        return $kd;
	}

    public function getCtfkdByEvent($id) {
		$matches = Event::find($id)->matches;
        $kdarr = ['kills' => 0, 'deaths' => 0];
		foreach ($matches as $match) {
			$games = $match->games;
			foreach ($games as $game) {
                $this->kdCalculator($kdarr, $game->ctf);
            }
		}
        $kd = $kdarr['kills'];
        if($kdarr['deaths'] != 0) {
            $kd = round($kdarr['kills'] / $kdarr['deaths'], 2);
        }
        return $kd;
	}

    public function getUplinkkdByEvent($id) {
		$matches = Event::find($id)->matches;
        $kdarr = ['kills' => 0, 'deaths' => 0];
		foreach ($matches as $match) {
			$games = $match->games;
			foreach ($games as $game) {
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
        $matches = Match::where('event_id', $event_id)->get();
        $maps = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->hp) {
                    foreach($game->hp->players()->get() as $player) {
                        if($player->player_id == $this->id) {
                            $maps++;
                        }
                    }
                }
            }
        }
        return $maps;
    }

    public function getCtfMapCountByEvent($event_id) {
        $matches = Match::where('event_id', $event_id)->get();
        $maps = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->ctf) {
                    foreach($game->ctf->players()->get() as $player) {
                        if($player->player_id == $this->id) {
                            $maps++;
                        }
                    }
                }
            }
        }
        return $maps;
    }

    public function getUplinkMapCountByEvent($event_id) {
        $matches = Match::where('event_id', $event_id)->get();
        $maps = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->uplink) {
                    foreach($game->uplink->players()->get() as $player) {
                        if($player->player_id == $this->id) {
                            $maps++;
                        }
                    }
                }
            }
        }
        return $maps;
    }

	public function getSndMapCountByEvent($event_id) {
        $matches = Match::where('event_id', $event_id)->get();
        $maps = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->snd) {
                    foreach($game->snd->players()->get() as $player) {
                        if($player->player_id == $this->id) {
                            $maps++;
                        }
                    }
                }
            }
        }
        return $maps;
    }

    public function getULDunksPM($event_id) {
        $matches = Match::where('event_id', $event_id)->get();
        $maps = $this->getUplinkMapCountByEvent($event_id);
        $dunks = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->uplink()->first()) {
                    $player = UplinkPlayer::where(
                        ['uplink_id' => $game->uplink()->first()->id, 
                        'player_id' => $this->id])->first();
                    if(count($player)) {
                        $dunks += $player->carries;
                    }
                }
            }
        }
        return ($maps != 0) ? round($dunks / $maps, 2) : 0;
    }
        

    public function getHpTime($event_id) {
        $matches = Match::where('event_id', $event_id)->get();
        $maps = $this->getHpMapCountByEvent($event_id);
        $time = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->hp()->first()) {
                    $player = HpPlayer::where(
                        ['hp_id' => $game->hp()->first()->id, 'player_id' => $this->id])->first();
                    if(count($player)) {
                        $time += $player->time;
                    }
                }
            }
        }
        return $time % 60 . ':' . $time / 60;
    }
        

    public function getHpKPM($event_id) {
        $matches = Match::where('event_id', $event_id)->get();
        $maps = $this->getHpMapCountByEvent($event_id);
        $kills = 0;
        foreach($matches as $match) {
            foreach($match->games as $game) {
                if($game->hp()->first()) {
                    $player = HpPlayer::where(
                        ['hp_id' => $game->hp()->first()->id, 'player_id' => $this->id])->first();
                    if(count($player)) {
                        $kills += $player->kills;
                    }
                }
            }
        }
        return ($maps != 0) ? round($kills / $maps, 2) : 0;
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
