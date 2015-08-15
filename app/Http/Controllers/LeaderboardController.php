<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Player;
use App\Events;

use View;

class LeaderboardController extends BaseController {

    public function view() {
        $players = parent::cacheRequest('stat:kd:all:all', function() {
            $with = ['rostermap', 'rostermap.roster', 'rostermap.roster.team'];
            $players = Player::with($with)->get();
            for($i = 0; $i < count($players); $i++)
            {
                $players[$i]->kd = $players[$i]->kd;
                parent::cacheSet('stat:kd:all:'.$players[$i]->id, 
                    $players[$i]->kd);
            }
            $players = $players->sortByDesc('kd');
            return $players;
        }, true);

        $slayers = parent::cacheRequest('stat:slayer:all:all', function() {
            $with = ['rostermap', 'rostermap.roster', 'rostermap.roster.team'];
            $slayers = Player::with($with)->get();
            for($i = 0; $i < count($slayers); $i++)
            {
                $slayers[$i]->slayer = $slayers[$i]->slayer();
                parent::cacheSet('stat:slayer:all:'.$slayers[$i]->id, 
                    $slayers[$i]->slayer());
            }
            $slayers = $slayers->sortByDesc('slayer');
            return $slayers;
        }, true);

        $sndPlayers = parent::cacheRequest('stat:sndkd:all:all', function() {
            $with = ['rostermap', 'rostermap.roster', 'rostermap.roster.team'];
            $players = Player::with($with)->get();
            for($i = 0; $i < count($players); $i++)
            {
                $players[$i]->sndkd = $players[$i]->sndkd();
                parent::cacheSet('stat:sndkd:all:'.$players[$i]->id, 
                    $players[$i]->sndkd());
            }
            $players = $players->sortByDesc('sndkd');
            return $players;
        }, true);

        return view('leaderboards.view', 
            compact('players', 'slayers', 'sndPlayers'));
    }

	public function viewByEvent($id) {
		$event = Events::find($id);
		$players = Player::all();
		$slayers = Player::all();
		$sndPlayers = Player::all();
		
		$players = $players->sortByDesc(function($player) use($id)
		{
			return $player->kdByEvent($id);
		});

		$slayers = $slayers->sortByDesc(function($slayerPlayer) use($id)
		{
			return $slayerPlayer->slayerByEvent($id);
		});

		$sndPlayers = $sndPlayers->sortByDesc(function($sndPlayer) use($id)
		{
			return $sndPlayer->sndkdByEvent($id);
		});

		// dd($players);
		return View::make('leaderboards.view', compact('event', 'players', 'slayers', 'sndPlayers'));
	}

	public function viewCTF() {
		$ctfCapsPlayers = Player::all();
		$ctfKDPlayers = Player::all();
		$ctfCapsPlayers = $ctfCapsPlayers->sortByDesc(function($player)
		{
			return $player->getCTFCapsAverage();
		});

		$ctfKDPlayers = $ctfKDPlayers->sortByDesc(function($player)
		{
			return $player->getCTFKD();
		});

		// dd($players);
		return View::make('leaderboards.view_ctf', compact('ctfCapsPlayers', 'ctfKDPlayers'));
	}

	public function viewUplink() {
		$uplinkPlayers = Player::all();
		$uplinkKDPlayers = Player::all();
		
		$uplinkPlayers = $uplinkPlayers->sortByDesc(function($player)
		{
			return $player->getUplinkAverage();
		});

		$uplinkKDPlayers = $uplinkKDPlayers->sortByDesc(function($player)
		{
			return $player->getUplinkKD();
		});

		// dd($players);
		return View::make('leaderboards.view_uplink', compact('uplinkPlayers', 'uplinkKDPlayers'));
	}

	public function viewSnD() {
		$sndKDPlayers = Player::all();
		$sndFBPlayers = Player::all();

		$sndKDPlayers = $sndKDPlayers->sortByDesc(function($player)
		{
			return $player->sndkd;
		});

		$sndFBPlayers = $sndFBPlayers->sortByDesc(function($player)
		{
			return $player->fb;
		});

		// dd($players);
		return View::make('leaderboards.view_snd', compact('sndKDPlayers', 'sndFBPlayers'));
	}

	public function viewTeam() {
	}


}
