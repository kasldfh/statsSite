<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Player;
use App\Events;
use View;
class LeaderboardController extends Controller {

	public function view() {
		$players = Player::all();
		$slayerPlayers = Player::all();
		$sndPlayers = Player::all();
		
		$players = $players->sortByDesc(function($player)
		{
			return $player->kd;
		});

		$slayerPlayers = $slayerPlayers->sortByDesc(function($slayerPlayer)
		{
			return $slayerPlayer->slayer;
		});

		$sndPlayers = $sndPlayers->sortByDesc(function($sndPlayer)
		{
			return $sndPlayer->sndkd;
		});

		return view('leaderboards.view', compact('players', 'slayerPlayers', 'sndPlayers'));
	}

	public function viewByEvent($id) {
		$event = Events::find($id);
		$players = Player::all();
		$slayerPlayers = Player::all();
		$sndPlayers = Player::all();
		
		$players = $players->sortByDesc(function($player) use($id)
		{
			return $player->kdByEvent($id);
		});

		$slayerPlayers = $slayerPlayers->sortByDesc(function($slayerPlayer) use($id)
		{
			return $slayerPlayer->slayerByEvent($id);
		});

		$sndPlayers = $sndPlayers->sortByDesc(function($sndPlayer) use($id)
		{
			return $sndPlayer->sndkdByEvent($id);
		});

		// dd($players);
		return View::make('leaderboards.view', compact('event', 'players', 'slayerPlayers', 'sndPlayers'));
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
