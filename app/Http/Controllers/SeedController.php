<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SeedController extends Controller {
    public function seed()
    {
        \Iseed::generateSeed('ctf');
        \Iseed::generateSeed('ctf_player');
        \Iseed::generateSeed('event');
        \Iseed::generateSeed('event_type');
        \Iseed::generateSeed('game');
        \Iseed::generateSeed('game_title');
        \Iseed::generateSeed('hp');
        \Iseed::generateSeed('hp_player');
        \Iseed::generateSeed('map');
        \Iseed::generateSeed('map_mode');
        \Iseed::generateSeed('match_table');
        \Iseed::generateSeed('match_type');
        \Iseed::generateSeed('migrations');
        \Iseed::generateSeed('mode');
        \Iseed::generateSeed('password_reminders');
        \Iseed::generateSeed('password_resets');
        \Iseed::generateSeed('player');
        \Iseed::generateSeed('player_roster');
        \Iseed::generateSeed('roster');
        \Iseed::generateSeed('roster_to_event');
        \Iseed::generateSeed('score_type');
        \Iseed::generateSeed('snd');
        \Iseed::generateSeed('snd_player');
        \Iseed::generateSeed('team');
        \Iseed::generateSeed('uplink');
        \Iseed::generateSeed('uplink_player');
        \Iseed::generateSeed('users');
        return 'successfully seeeded all tables';
    }
}
