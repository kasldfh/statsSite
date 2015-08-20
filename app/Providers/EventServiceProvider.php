<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Models\HpPlayer;
use App\Models\CtfPlayer;
use App\Models\UplinkPlayer;
use App\Models\SndPlayer;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        HpPlayer::saving(function($hp_player) {
            $this->validateHpPlayer($hp_player);
        }); 
        CtfPlayer::saving(function($ctf_player) {
            $this->validateCtfPlayer($ctf_player);
        }); 
        UplinkPlayer::saving(function($uplink_player) {
            $this->validateCtfPlayer($uplink_player);
        }); 
        SndPlayer::saving(function($snd_player) {
            $this->validateCtfPlayer($snd_player);
        }); 
        //
    }

    private function validateHpPlayer($hp_player) {
        if($hp_player->kills == "")
            $hp_player->kills = null;

        if($hp_player->deaths == "")
            $hp_player->deaths = null;

        if($hp_player->captures == "")
            $hp_player->captures = null;

        if($hp_player->defends == "")
            $hp_player->defends = null;
    }

    private function validateCtfPlayer($ctf_player) {
        if($ctf_player->kills == "")
            $ctf_player->kills = null;

        if($ctf_player->deaths == "")
            $ctf_player->deaths = null;

        if($ctf_player->captures == "")
            $ctf_player->captures = null;

        if($ctf_player->defends == "")
            $ctf_player->defends = null;

        if($ctf_player->returns == "")
            $ctf_player->returns = null;
    }

    private function validateUplinkPlayer($uplink_player) {
        if($uplink_player->kills == "")
            $uplink_player->kills = null;

        if($uplink_player->deaths == "")
            $uplink_player->deaths = null;

        if($uplink_player->uplinks == "")
            $uplink_player->uplinks = null;

        if($uplink_player->makes == "")
            $uplink_player->makes = null;

        if($uplink_player->misses == "")
            $uplink_player->misses = null;
    }

    private function validateSndPlayer($snd_player) {
        if($snd_player->kills == "")
            $snd_player->kills = null;

        if($snd_player->deaths == "")
            $snd_player->deaths = null;

        if($snd_player->plants == "")
            $snd_player->plants = null;

        if($snd_player->defues == "")
            $snd_player->defues = null;

        if($snd_player->first_bloods == "")
            $snd_player->first_bloods = null;

        if($snd_player->first_blood_wins == "")
            $snd_player->first_blood_wins = null;

        if($snd_player->last_man_standing == "")
            $snd_player->last_man_standing = null;

        if($snd_player->last_man_standing_wins == "")
            $snd_player->last_man_standing_wins = null;
    }
}
