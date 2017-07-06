<?php
namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Player;
use App\Models\Event;
use App\Models\CacheItem;
use App\Models\Roster;

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
     * event:{id}               -- event by id
     * rosplay:all              -- roster with playermap, json encoded

     * rosterevent:{eventid}:{rosterid} -- roster's standing at an event (with team)
     * rosterevent:{eventid}:{all}      -- all roster's standings at event (with team)

     * stat:{stat}:{all}:{all}      -- all events, all player kd's, sorted desc, json encoded
     * stat:{stat}:{all}:{playerid} --      player kd, for all events
     * stat:{stat}:{eventid}:{playerid} -- player kd at event
     * stat:{topstat}:{eventid}:all -- stat with only top performer for this event
    */

    public function handle() {
        set_time_limit(100000);
        $this->cacheEvent($this->event_id);
    }

    public function cacheEvent($event_id) {
        set_time_limit(100000);
        $with = ['rosters', 'rosters.roster', 'rosters.roster.team'];
        $event = Event::where('id', $event_id)->with($with)->first();
        //$event->getHighestHpKills();
        $this->set("event:$event_id", $event);
        $players = collect();
        foreach($event->rosters as &$roster_event) {
            $roster_standing = $roster_event->placing;
            $roster_event->wins = $roster_event->getWins();
            $roster_event->losses = $roster_event->getLosses();
            $roster_event->winpercent = $roster_event->getWinPercent();
            $roster_event->mapwins = $roster_event->getMapWins();
            $roster_event->maplosses = $roster_event->getMapLosses();

            $this->set("rosterevent:$event_id:" . $roster_event->roster->id,
                $roster_event);
            


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
                $player->slayer = $player->getSlayerAttribute($event_id);
                $current_roster = $player->rostermap()->first()->roster_id;
                $team = Roster::where('id', $current_roster)->with('team')->first()->team;
                $player->team_logo = $team->logo_url;

                //overall stats
                $this->set('stat:kd:'.$event_id.':'.$player->id, $player->kd);
                $this->set('stat:mapcount:'.$event_id.':'.$player->id, 
                    $player->map_count);
                //mode specific stats
                $this->set('stat:hpkpm:'.$event_id.':'.$player->id,
                    $player->hpkpm);
                $this->set('stat:sndkd:'.$event_id.':'.$player->id,
                    $player->sndkd);
                $this->set('stat:hpkd:'.$event_id.':'.$player->id,
                    $player->hpkd);
                $this->set('stat:ctfkd:'.$event_id.':'.$player->id,
                    $player->ctfkd);
                $this->set('stat:uplinkkd:'.$event_id.':'.$player->id,
                    $player->uplinkkd);
                $this->set('stat:sndmaps:'.$event_id.':'.$player->id,
                    $player->snd_mapcount);
                $this->set('stat:hpmaps:'.$event_id.':'.$player->id,
                    $player->hp_mapcount);
                $this->set('stat:uplinkmaps:'.$event_id.':'.$player->id,
                    $player->uplink_mapcount);
                $this->set('stat:ctfmaps:'.$event_id.':'.$player->id,
                    $player->ctf_mapcount);
                $this->set("stat:slayer:$event_id:" . $player->id,
                    $player->slayer);
                $this->set("stat:hptime:$event_id:" . $player->id,
                    $player->hp_time);
                $this->set("stat:uplink_dunks:$event_id:" . $player->id,
                    $player->uplink_dunks);

                //not sure how this gets set to begin with but we dont need it
                unset($player->player);
                $players->push($player);
                //dd(Redis::get('stat:sndkd:'.$event_id.':'.$player->id));
            }
        }

        $event->rosters = $event->rosters->sortBy('placing');
        $this->set("rosterevent:$event_id:all",
                $event->rosters);


        //overall stats
        $kd_leaderboard = $players->sortByDesc('kd');
        $hp_time_leaderboard = $players->sortByDesc('hp_time');
        $uldunks_leaderboard = $players->sortByDesc('uplink_dunks');
        $slayer_leaderboard = $players->sortByDesc('slayer');
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
        $this->set('stat:kd:'.$event_id.':all', $kd_leaderboard);
        $this->set('stat:hp_time:'.$event_id.':all', $hp_time_leaderboard);
        $this->set('stat:uplink_dunks:'.$event_id.':all', $uldunks_leaderboard);
        $this->set('stat:slayer:'.$event_id.':all', $slayer_leaderboard);
        //$this->set('stat:mapcount:'.$event_id.':all', $mapcount_leaderboard);
        ////mode specific stats
        //$this->set('stat:sndkd:'.$event_id.':all', $sndkd_leaderboard);
        //$this->set('stat:hpkd:'.$event_id.':all', $hpkd_leaderboard);
        //$this->set('stat:ctfkd:'.$event_id.':all', $ctfkd_leaderboard);
        //$this->set('stat:uplinkkd:'.$event_id.':all', $uplinkkd_leaderboard);
        //$this->set('stat:snd_mapcount:'.$event_id.':all', $snd_mapcount_leaderboard);
        //$this->set('stat:hp_mapcount:'.$event_id.':all', $hp_mapcount_leaderboard);
        //$this->set('stat:uplink_mapcount:'.$event_id.':all', $uplink_mapcount_leaderboard);
        //$this->set('stat:ctf_mapcount:'.$event_id.':all', $ctf_mapcount_leaderboard);

        //top performers stats
        $this->set("stat:topkd:$event_id:all", $kd_leaderboard[0]);
        $this->set("stat:topslayer:$event_id:all", $slayer_leaderboard[0]);
        $this->set("stat:tophp_time:$event_id:all", $hp_time_leaderboard[0]);
        $this->set("stat:topuplink_dunks:$event_id:all", $uldunks_leaderboard[0]);

    }
    private function set($key, $value) {
        $item = CacheItem::where('name', $key)->first();
        if(!isset($item)) {
            $item = new CacheItem;
            $item->name = $key;
        }
        $item->value = json_encode($value);
        $item->save();
    }
}
