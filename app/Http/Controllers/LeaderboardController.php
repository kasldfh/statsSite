<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Player;
class LeaderboardController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        //return $users;
        return view('users.index')->with('users', $users);
    }
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

		// dd($players);
		return view('leaderboards.view', compact('players', 'slayerPlayers', 'sndPlayers'));
	}
}

