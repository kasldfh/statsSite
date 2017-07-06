<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Event extends Model {

	public $timestamps = true; 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function title() {
		return $this->hasOne('App\Models\GameTitle', 'id', 'game_title_id');
	}

	public function type() {
		return $this->hasOne('App\Models\EventType', 'id', 'event_type_id');
	}

	public function matches() {
		return $this->hasMany('App\Models\Match', 'event_id', 'id');
	}

    public function rosters() {
        return $this->hasMany('App\Models\RosterEvent', 'event_id', 'id')->with('roster');
    }

    public function getHighestHpKills() {
        $allrecords = collect();
        foreach($this->matches as $match) {
            foreach($match->games as $game) {
                dd("lele");
                $hp = $game->hp();
                if(isset($hp)) {
                    $allrecords->add($game->hp()->players()->get());
                }
            }
        }
    }
    //TODO: remove this method?
	public function getPlayed($id) {
		$matches = $this->matches;
		$kills = 0;
		$deaths = 0;
		foreach ($matches as $match) {
			$games = $match->games;
			foreach ($games as $game) {
				$ctf = $game->ctf ? $game->ctf->get() : [];
				$snd = $game->snd ? $game->snd->get() : [];
				$hp = $game->hp ? $game->hp->get() : [];
				$uplink = $game->uplink ? $game->uplink->get() : [];
				foreach ($ctf as $ctf_game) {
					foreach ($ctf_game->players as $player) {
						if($player->player_id == $id) {
							$kills += $player->kills;
							$deaths += $player->deaths;
						}
					}
				}
				foreach ($snd as $snd_game) {
					foreach ($snd_game->players as $player) {
						if($player->player_id == $id) {
							$kills += $player->kills;
							$deaths += $player->deaths;
						}
					}
				}
				foreach ($hp as $hp_game) {
					foreach ($hp_game->players as $player) {
						if($player->player_id == $id) {
							$kills += $player->kills;
							$deaths += $player->deaths;
						}
					}
				}
				foreach ($uplink as $uplink_game) {
					foreach ($uplink_game->players as $player) {
						if($player->player_id == $id) {
							$kills += $player->kills;
							$deaths += $player->deaths;
						}
					}
				}
			}
		}
		return $deaths != 0 ? round(($kills / $deaths), 2) : 0;
	}
}
