<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
	
class FrontEndTeamController extends Controller {

	public function show($id) {
		$team = Team::where('team_url', 'like', $id)->first();
		$currentRoster = $team->getCurrentAttribute();
		$roster = $currentRoster->playermap;
		return View::make('teams.view', compact('roster')); 

	}

	function cmp($b, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}



}
