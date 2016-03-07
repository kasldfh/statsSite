<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Player;
use App\Models\Event;

use View;
	
class FrontEndPlayerController extends Controller {

	public function view($alias) {
		$player = Player::where('alias', 'like', $id)->first();
		$players = Player::all();
		$highest = $players[0];
		$total = 0;
		$count = 0;
		foreach ($players as $player1) {
			if($player1->kd > $highest->kd) {
				$highest = $player1;
			}
			if($player1->kd != 0) {
				//echo $player->kd . "\n";
				$total += $player1->kd;
				$count += 1;
			}

		}
		($count > 0) ? $average = round($total / $count, 2) : $average = 0;
		$roster = $player->rostermap;
		if(count($roster) > 0) {
			$roster = $roster[0]->roster->playermap;
			$team = 0;
			$team_count = 0;
			foreach ($roster as $player1) {
				$kd = $player1->player->kd;
				if($kd != 0) {
					$team += $player1->player->kd;
					$team_count++;
				}
			}
			$team_count != 0 ? $team = round($team / $team_count, 2) : $team = 0;
		} else {
			$team = 0;
		}
		$roster = $player->rostermap;
		if(count($roster) > 0) {
			$color = $roster[0]->roster->team->team_color;

			$team_name = $roster[0]->roster->team->name;
			$color == "#000000" ? $color = "#E01E3C": NULL;
		} else {
			$color = "#E01E3C";
			$team_name = "F/A";
		}
		$events = Event::orderBy('id', 'desc')->get();
		$event_names = [];
		$event_kd = [];
		foreach ($events as $event) {
			$kd = $event->getPlayed($player->id);
			if($kd) {
				$event_names[] =  $event->name;
				$event_kd[] = $kd;
			}
		}
		$event_names = array_reverse($event_names);
		$event_kd = array_reverse($event_kd);
		$event_names[] = "test";
		$event_kd[] = 1.3;
		return View::make('frontend.player', compact('player', 'average', 'highest', 'team', 'color', 'team_name', 'event_names', 'event_kd'));
	}

	public function viewDetailed($id) {
		$player = Player::where('alias', 'like', $id)->first();
		
		$roster = $player->rostermap;
		if(count($roster) > 0) {
			$color = $roster[0]->roster->team->team_color;

			$team_name = $roster[0]->roster->team->name;
			$team = $roster[0]->roster->team;
			$color == "#000000" ? $color = "#E01E3C": NULL;
		} else {
			$color = "#E01E3C";
			$team_name = "F/A";
		}
		
		
		return View::make('players.detailed', compact('player',  'team', 'color', 'team_name'));
	}

}
