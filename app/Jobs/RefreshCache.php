<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Player;
use App\Models\Event;

use Redis;

class RefreshCache extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $event_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    /* Cache keys 
     * player:{id}              -- player model, json encoded
     * player:all               -- player model all, json encoded
     * event:all                -- all events, json encoded
     * rosplay:all              -- roster with playermap, json encoded

     * stat:{stat}:{all}:{all}      -- all events, all player kd's, sorted desc, json encoded
     * stat:{stat}:{all}:{playerid} --      player kd, for all events
     * stat:{stat}:{eventid}:{playerid} -- player kd at event
     *
    */

    public function handle() {
        set_time_limit(100000);
        $this->cacheEvent($this->event_id);
    }

    public function cacheEvent($event_id) {
        set_time_limit(100000);
        $with = ['rostermap', 'rostermap.roster', 'rostermap.roster.team'];
        $event = Event::find($event_id);
        $players = collect();
        foreach($event->rosters as $roster_event) {
            foreach($roster_event->roster->playermap as $playermap) {
                //todo: set up leaderboards as well (this is just doing
                //indivdual stats atm

                //get player's stats for this event
                $player = $playermap->player;
                //overall stats
                $player->kd = $player->kdByEvent($event_id);
                $player->map_count = $player->getMapCountByEvent($event_id);
                //mode specific stats
                $player->hpkpm = $player->getHpKPM($event_id);
                $player->sndkd = $player->getSndkdByEvent($event_id);
                $player->hpkd = $player->getHpkdByEvent($event_id);
                $player->ctfkd = $player->getCtfkdByEvent($event_id);
                $player->uplinkkd = $player->getUplinkkdByEvent($event_id);
                $player->snd_mapcount = $player->getSndMapCountByEvent($event_id);
                $player->hp_mapcount = $player->getHpMapCountByEvent($event_id);
                $player->uplink_mapcount = $player->getUplinkMapCountByEvent($event_id);
                $player->ctf_mapcount = $player->getCtfMapCountByEvent($event_id);
                $player->uplink_dunks = $player->getULDunksPM($event_id);
                $player->hp_time = $player->getHpTime($event_id);

                //overall stats
                Redis::set('stat:kd:'.$event_id.':'.$player->id, $player->kd);
                Redis::set('stat:mapcount:'.$event_id.':'.$player->id, 
                    $player->map_count);
                //mode specific stats
                Redis::set('stat:hpkpm:'.$event_id.':'.$player->id,
                    $player->hpkpm);
                Redis::set('stat:sndkd:'.$event_id.':'.$player->id,
                    $player->sndkd);
                Redis::set('stat:hpkd:'.$event_id.':'.$player->id,
                    $player->hpkd);
                Redis::set('stat:ctfkd:'.$event_id.':'.$player->id,
                    $player->ctfkd);
                Redis::set('stat:uplinkkd:'.$event_id.':'.$player->id,
                    $player->uplinkkd);
                Redis::set('stat:sndmaps:'.$event_id.':'.$player->id,
                    $player->snd_mapcount);
                Redis::set('stat:hpmaps:'.$event_id.':'.$player->id,
                    $player->hp_mapcount);
                Redis::set('stat:uplinkmaps:'.$event_id.':'.$player->id,
                    $player->uplink_mapcount);
                Redis::set('stat:ctfmaps:'.$event_id.':'.$player->id,
                    $player->ctf_mapcount);
                //not sure how this gets set to begin with but we dont need it
                unset($player->player);
                $players->push($player);
                //dd(Redis::get('stat:sndkd:'.$event_id.':'.$player->id));
            }
        }
        //overall stats
        $kd_leaderboard = $players->sortByDesc('kd');
        //$mapcount_leaderboard = $players->sortByDesc('map_count');
        ////mode specific stats
        //$sndkd_leaderboard = $players->sortByDesc('sndkd');
        //$hpkd_leaderboard = $players->sortByDesc('hpkd');
        //$ctfkd_leaderboard = $players->sortByDesc('ctfkd');
        //$uplinkkd_leaderboard = $players->sortByDesc('uplinkkd');
        //$snd_mapcount_leaderboard = $players->sortByDesc('snd_mapcount');
        //$hp_mapcount_leaderboard = $players->sortByDesc('hp_mapcount');
        //$uplink_mapcount_leaderboard = $players->sortByDesc('uplink_mapcount');
        //$ctf_mapcount_leaderboard = $players->sortByDesc('ctf_mapcount');

        //overall stats
        Redis::set('stat:kd:'.$event_id.':all', $kd_leaderboard);
        //Redis::set('stat:mapcount:'.$event_id.':all', $mapcount_leaderboard);
        ////mode specific stats
        //Redis::set('stat:sndkd:'.$event_id.':all', $sndkd_leaderboard);
        //Redis::set('stat:hpkd:'.$event_id.':all', $hpkd_leaderboard);
        //Redis::set('stat:ctfkd:'.$event_id.':all', $ctfkd_leaderboard);
        //Redis::set('stat:uplinkkd:'.$event_id.':all', $uplinkkd_leaderboard);
        //Redis::set('stat:snd_mapcount:'.$event_id.':all', $snd_mapcount_leaderboard);
        //Redis::set('stat:hp_mapcount:'.$event_id.':all', $hp_mapcount_leaderboard);
        //Redis::set('stat:uplink_mapcount:'.$event_id.':all', $uplink_mapcount_leaderboard);
        //Redis::set('stat:ctf_mapcount:'.$event_id.':all', $ctf_mapcount_leaderboard);
    }
}
