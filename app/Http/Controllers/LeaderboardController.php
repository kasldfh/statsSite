<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Player;
use App\Models\Event;

use View;

class LeaderboardController extends BaseController {

    public function view($event_id) {
        $event = Event::findOrFail($event_id);
        $players = json_decode(parent::cacheGet('stat:kd:'.$event_id.':all'));

        return view('frontend.leaderboards', 
            compact('players', 'event'));
    }

	public function viewByEvent($id) {
		$event = Event::find($id);
		$players = Player::all();
		$slayers = Player::all();
		$sndPlayers = Player::all();
		
		$players = $players->sortByDesc(function($player) use($id)
		{
			return $player->kdByEvent($id);
		});

		$slayers = $slayers->sortByDesc(function($slayerPlayer) use($id)
		{
			return $slayerPlayer->slayer($id);
		});

		$sndPlayers = $sndPlayers->sortByDesc(function($sndPlayer) use($id)
		{
			return $sndPlayer->sndkd($id);
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
			return $player->sndkd();
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
