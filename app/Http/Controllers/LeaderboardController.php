<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use View;//use view namespace so it can find the view
class LeaderboardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $players = array(
            array(
                "name" => "le",
                "photo_url" => null,
                "rostermap" => null,
                "alias" => "lealias"
            ),  
            array(
                "name" => "le2",
                "photo_url" => null,
                "rostermap" => null,
                "alias" => "le2alias"
            )  
        );
        $players = ['lelelele', 'le', 'lelelele'];
        return view('leaderboards.about', compact('players'));

        //$players = collect("name" => "le"], ["name" => "le2"]);
        $players = collect($players);
        return View::make('leaderboards.view')->with('players');
        //return view('leaderboards.view', compact('players'));
    }
}
