<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;

use App\Models\Event;
use App\Models\RosterEvent;
use App\Models\PlayerRoster;
use App\Models\Roster;
use App\Models\Player;
use App\Models\Team;
use App\Models\GameTitle;
use App\Models\Mode;
use App\Models\Map;
use App\Models\MapMode;

class TestController extends Controller {
    public function statUploader() {
        /* This script provides an easy way to enter:
         * - all the maps, modes and mapmodes for every game (ghosts, iw, bo3, aw)
         * - all teams (from previous events.)
         * - all players
         * - all rosters
         * - all events
         * - all roster_events
         */
        //array to have every player's name map to their id

        $gameTitleIds = $this->enterMapModesAndEvents();
        //ghosts
        $eventRosters = $this->getGhostsRosters();
        $ghosts_id = $gameTitleIds["Ghosts"];
        $this->enterEventRosters($eventRosters, $ghosts_id);
        //aw
        $eventRosters = $this->getAWRosters();
        $aw_id = $gameTitleIds["Advanced Warfare"];
        $this->enterEventRosters($eventRosters, $aw_id);
        //iw
        $eventRosters = $this->getIWRosters();
        $iw_id = $gameTitleIds["Infinite Warfare"];
        $this->enterEventRosters($eventRosters, $iw_id);
    }


    public function enterEventRosters($eventRosters, $game_title_id) {
        foreach($eventRosters as $eventName => $rosters) {
            //insert the event
            $event = new Event;
            $event->game_title_id = $game_title_id;
            $event->name = $eventName;
            //TODO: scoretype or something?
            $event->save();
            foreach($rosters as $teamName => $rosterPlayers) {
                $roster_id = $this->checkRosterExists($teamName, $rosterPlayers);
                $roster;
                if(!$roster_id) {

                    $roster = new Roster;
                    /* $roster->team_id = $teams[$teamName]; */
                    $roster->team_id = $this->enterTeam($teamName);
                    $roster->save();

                    $rosterEvent = new RosterEvent;
                    $rosterEvent->roster_id = $roster->id;
                    $rosterEvent->event_id = $event->id;
                    $rosterEvent->save();

                    foreach($rosterPlayers as $player) {
                        $playerRoster = new PlayerRoster;
                        $playerRoster->player_id = $this->enterPlayer($player);
                        $playerRoster->starter = 1;
                        $playerRoster->roster_id = $roster->id;
                        $playerRoster->save();
                    }
                }
                elseif($roster_id) {
                    $roster = Roster::find($roster_id);
                }
                //add roster to event
                $rosterEvent = new RosterEvent;
                $rosterEvent->event_id = $event->id;
                $rosterEvent->roster_id = $roster->id;
                $rosterEvent->save();
            }

        } 
    }

    //given an array of four player ids and a team name, will return 
    //the roster id if it exists, otherwise it will return 0
    public function checkRosterExists($teamName, $rosterPlayers) {

        $playerids = [];
        foreach($rosterPlayers as $rosterPlayer) {
            $playerids[$rosterPlayer] = $this->enterPlayer($rosterPlayer);
            /* $playerids[$rosterPlayer] = $players[$rosterPlayer]; */
        }

        //get all rosters for the team
        $teamId = $this->enterTeam($teamName);
        $rosters = Roster::where('team_id', $teamId)->get();
        foreach($rosters as $roster) {
            $exists = 1; //if we find the roster already exists, set this to 1
            $starters = $roster->starters();
            foreach($starters as $starter) {
                //TODO: case sensitivity of in_array?
                if(!in_array($starter->id, $playerids)) {
                    $exists = 0;
                }
            }
            if($exists) {
                return $roster->id;
            }
        }
        return 0;
    }

    public function setEventRosters($gameTitleId, $eventId, $rosters) {

    }
    //do one thing and one thing only aint nobody got time fo dat
    public function enterMapModesAndEvents() {
        //ghosts
        $ghosts = new GameTitle;
        $ghosts->title = "Ghosts";
        $ghosts->save();

        //IW
        $iw = new GameTitle;
        $iw->title = "Infinite Warfare";
        $iw->save();
        //aw
        $aw = new GameTitle;
        $aw->title = "Advanced Warfare";
        $aw->save();
        $gameTitleIds = [$iw->title => $iw->id, $aw->title => $aw->id, $ghosts->title => $ghosts->id];


        //***************************MAPMODES*******************************
        #we also need to enter domination as a game mode. ghosts = blitz, dom, snd, 
        $dom = new Mode;
        $dom->name = "Domination";
        $dom->game_title_id = $ghosts->id;
        $dom->save();
        $blitz = new Mode;
        $blitz->name = "Blitz";
        $blitz->game_title_id = $ghosts->id;
        $blitz->save();
        $snd = new Mode;
        $snd->name = "Search and Destroy";
        $snd->game_title_id = $ghosts->id;
        $snd->save();

        //we need to enter all the maps
        $freight = new Map;
        $freight->name = "Freight";
        $freight->game_title_id = $ghosts->id;
        $freight->save();
        $octane = new Map;
        $octane->name = "Octane";
        $octane->game_title_id = $ghosts->id;
        $octane->save();
        $sovereign = new Map;
        $sovereign->name = "Sovereign";
        $sovereign->game_title_id = $ghosts->id;
        $sovereign->save();
        $warhawk = new Map;
        $warhawk->name = "Warhawk";
        $warhawk->game_title_id = $ghosts->id;
        $warhawk->save();
        $strikezone = new Map;
        $strikezone->name = "Strike Zone";
        $strikezone->game_title_id = $ghosts->id;
        $strikezone->save();

        //now we do the map_modes. 
        //freight - Domination
        $mapMode = new MapMode;
        $mapMode->map_id = $freight->id;
        $mapMode->mode_id = $dom->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();

        //octane - Domination 
        $mapMode = new MapMode;
        $mapMode->map_id = $octane->id;
        $mapMode->mode_id = $dom->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();

        //sovereign - Domination 
        $mapMode = new MapMode;
        $mapMode->map_id = $sovereign->id;
        $mapMode->mode_id = $dom->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();

        //strike Zone - Domination
        $mapMode = new MapMode;
        $mapMode->map_id = $strikezone->id;
        $mapMode->mode_id = $dom->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();

        //octane - Blitz 
        $mapMode = new MapMode;
        $mapMode->map_id = $octane->id;
        $mapMode->mode_id = $blitz->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();
        //freight - Blitz 
        $mapMode = new MapMode;
        $mapMode->map_id = $freight->id;
        $mapMode->mode_id = $blitz->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();
        //warhawk - Blitz 
        $mapMode = new MapMode;
        $mapMode->map_id = $warhawk->id;
        $mapMode->mode_id = $blitz->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();
        //freight - Search & Destroy 
        $mapMode = new MapMode;
        $mapMode->map_id = $freight->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();
        //octane - Search & Destroy 
        $mapMode = new MapMode;
        $mapMode->map_id = $octane->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();
        //sovereign - Search & Destroy 
        $mapMode = new MapMode;
        $mapMode->map_id = $sovereign->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();
        //warhawk - Search & Destroy
        $mapMode = new MapMode;
        $mapMode->map_id = $warhawk->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $ghosts->id;
        $mapMode->save();

        //*******************************************************AW
        //AW modes
        $snd = new Mode;
        $snd->name = "Search and Destroy";
        $snd->game_title_id = $aw->id;
        $snd->save();
        $up = new Mode;
        $up->name = "Uplink";
        $up->game_title_id = $aw->id;
        $up->save();
        $hp = new Mode;
        $hp->name = "Hardpoint";
        $hp->game_title_id = $aw->id;
        $hp->save();

        //AW maps: biolab, compound, detroit, drift, solar, recovery, skyrise, riot, comeback, parliament
        $biolab = new Map;
        $biolab->name = "Biolab";
        $biolab->game_title_id = $aw->id;
        $biolab->save();
        $compound = new Map;
        $compound->name = "Compound";
        $compound->game_title_id = $aw->id;
        $compound->save();
        $detroit = new Map;
        $detroit->name = "Detroit";
        $detroit->game_title_id = $aw->id;
        $detroit->save();
        $drift = new Map;
        $drift->name = "Drift";
        $drift->game_title_id = $aw->id;
        $drift->save();
        $solar = new Map;
        $solar->name = "Solar";
        $solar->game_title_id = $aw->id;
        $solar->save();
        $recovery = new Map;
        $recovery->name = "Recovery";
        $recovery->game_title_id = $aw->id;
        $recovery->save();
        $skyrise = new Map;
        $skyrise->name = "Skyrise";
        $skyrise->game_title_id = $aw->id;
        $skyrise->save();
        $riot = new Map;
        $riot->name = "Riot";
        $riot->game_title_id = $aw->id;
        $riot->save();
        $comeback = new Map;
        $comeback->name = "Comeback";
        $comeback->game_title_id = $aw->id;
        $comeback->save();
        $parliament = new Map;
        $parliament->name = "Parliament";
        $parliament->game_title_id = $aw->id;
        $parliament->save();
        $retreat = new Map;
        $retreat->name = "Retreat";
        $retreat->game_title_id = $aw->id;
        $retreat->save();


        //AW map_modes

        //Hardpoint: Bio Lab
        $mapMode = new MapMode;
        $mapMode->map_id = $biolab->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Hardpoint: Compound (DLC Mapsets)
        $mapMode = new MapMode;
        $mapMode->map_id = $compound->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Hardpoint: Detroit
        $mapMode = new MapMode;
        $mapMode->map_id = $detroit->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Hardpoint: Drift (DLC Mapsets)
        $mapMode = new MapMode;
        $mapMode->map_id = $drift->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Hardpoint: Retreat
        $mapMode = new MapMode;
        $mapMode->map_id = $retreat->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Hardpoint: Solar
        $mapMode = new MapMode;
        $mapMode->map_id = $solar->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Search and Destroy: Bio Lab
        $mapMode = new MapMode;
        $mapMode->map_id = $biolab->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Search and Destroy: Detroit
        $mapMode = new MapMode;
        $mapMode->map_id = $detroit->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Search and Destroy: Recovery
        $mapMode = new MapMode;
        $mapMode->map_id = $recovery->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Search and Destroy: Riot
        $mapMode = new MapMode;
        $mapMode->map_id = $riot->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Search and Destroy: Skyrise (DLC Mapsets)
        $mapMode = new MapMode;
        $mapMode->map_id = $skyrise->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Search and Destroy: Solar
        $mapMode = new MapMode;
        $mapMode->map_id = $solar->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Uplink: Bio Lab
        $mapMode = new MapMode;
        $mapMode->map_id = $biolab->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Uplink: Comeback
        $mapMode = new MapMode;
        $mapMode->map_id = $comeback->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Uplink: Detroit
        $mapMode = new MapMode;
        $mapMode->map_id = $detroit->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();
        //Uplink: Parliament (DLC Mapsets)
        $mapMode = new MapMode;
        $mapMode->map_id = $parliament->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $aw->id;
        $mapMode->save();

        //BO3 stuff is already in. No need to re-enter. 
        //Capture The Flag - Breach
        //Capture The Flag - Evac
        //Capture The Flag - Fringe
        //Capture The Flag - Stronghold
        //Hardpoint - Breach
        //Hardpoint - Evac
        //Hardpoint - Fringe
        //Hardpoint - Stronghold
        //Search & Destroy - Breach
        //Search & Destroy - Evac
        //Search & Destroy - Fringe
        //Search & Destroy - Hunted
        //Search & Destroy - Infection
        //Search & Destroy - Redwood
        //Search & Destroy - Stronghold
        //Uplink - Breach
        //Uplink - Evac
        //Uplink - Fringe
        //Uplink - Infection


        //IW modes
        $snd = new Mode;
        $snd->name = "Search and Destroy";
        $snd->game_title_id = $iw->id;
        $snd->save();
        $up = new Mode;
        $up->name = "Uplink";
        $up->game_title_id = $iw->id;
        $up->save();
        $hp = new Mode;
        $hp->name = "Hardpoint";
        $hp->game_title_id = $iw->id;
        $hp->save();

        //IW maps - Breakout, Retaliation, Scorch, Throwback, Crusher, Frost, Precinct
        $breakout = new Map;
        $breakout->name = "Breakout";
        $breakout->game_title_id = $iw->id;
        $breakout->save();
        $retaliation = new Map;
        $retaliation->name = "Retaliation";
        $retaliation->game_title_id = $iw->id;
        $retaliation->save();
        $scorch = new Map;
        $scorch->name = "Scorch";
        $scorch->game_title_id = $iw->id;
        $scorch->save();
        $throwback = new Map;
        $throwback->name = "Throwback";
        $throwback->game_title_id = $iw->id;
        $throwback->save();
        $crusher = new Map;
        $crusher->name = "Crusher";
        $crusher->game_title_id = $iw->id;
        $crusher->save();
        $frost = new Map;
        $frost->name = "Frost";
        $frost->game_title_id = $iw->id;
        $frost->save();
        $precinct = new Map;
        $precinct->name = "Precinct";
        $precinct->game_title_id = $iw->id;
        $precinct->save();

        //IW map_modes
        //Breakout - Hardpoint
        $mapMode = new MapMode;
        $mapMode->map_id = $breakout->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Retaliation - Hardpoint
        $mapMode = new MapMode;
        $mapMode->map_id = $retaliation->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Scorch - Hardpoint
        $mapMode = new MapMode;
        $mapMode->map_id = $scorch->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Throwback - Hardpoint
        $mapMode = new MapMode;
        $mapMode->map_id = $throwback->id;
        $mapMode->mode_id = $hp->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Crusher - Search and Destroy
        $mapMode = new MapMode;
        $mapMode->map_id = $crusher->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Retaliation - Search and Destroy
        $mapMode = new MapMode;
        $mapMode->map_id = $retaliation->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Breakout - Search and Destroy
        $mapMode = new MapMode;
        $mapMode->map_id = $breakout->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Throwback - Search and Destroy
        $mapMode = new MapMode;
        $mapMode->map_id = $throwback->id;
        $mapMode->mode_id = $snd->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Frost - Uplink
        $mapMode = new MapMode;
        $mapMode->map_id = $frost->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Precinct - Uplink
        $mapMode = new MapMode;
        $mapMode->map_id = $precinct->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();
        //Throwback - Uplink
        $mapMode = new MapMode;
        $mapMode->map_id = $throwback->id;
        $mapMode->mode_id = $up->id;
        $mapMode->game_title_id = $iw->id;
        $mapMode->save();

        return $gameTitleIds;
    }

    //enters the player and returns id
    //if player already exists, it will return the id without modifying the database
    public function enterPlayer($alias) {
        $player = Player::where('alias', $alias)->first();
        //enter the actual player
        if(!$player) {
            $player = new Player;
            $player->alias = $alias;
            $player->save();
        }
        return $player->id;
    }

    //enters the team and returns id
    //if team already exists, it will return the id without modifying the database
    public function enterTeam($name) {
        $team = Team::where('name', $name)->first();
        //enter the actual player
        if(!$team) {
            $team = new Team;
            $team->name = $name;
            $team->save();
        }
        return $team->id;
    }

    //structure should be $events[event_name][array_of_rosters][array_of_players_per_roster],
    public function getGhostsRosters() {
        //ghosts champs
        return [
            "CoD Champs Ghosts" => [
                'Aztek Gaming' => [ 'Afro', 'Clumzy', 'Dynamic', 'NeoZDaBestia'],
                'Brazil 5 Stars' => ['XLNC', 'H', 'Le', 'Coco'],
                'compLexity' => ['Aches', 'TeePee', 'Crimsix', 'Karma'],
                'Echelon' => ['BLaQkRoW', 'Impulse', 'Cypher', 'Syns'],
                'EnVyUs' => ['Rambo', 'Merk', 'Nameless', 'Studyy'],
                'Epsilon Esports' => ['Tommey', 'Swanny', 'Flux', 'Jurd'],
                'FaZe' => ['Jkap', 'Replays', 'Classic', 'Proofy'],
                'Immunity' => ['Naked', 'Buzzo', 'Shockz', 'Rampage'],
                'Killerfish' => ['Blackk', 'Theros', 'AyKon', 'HasBroken'],
                'Klarity Team' => ['SkittleZ', 'Andy', 'aziz', 'MoToD'],
                'Lightning Pandas' => ['Shane', 'Necrome', 'Randm', 'Ramba'],
                'Nsp' => ['Artshot', 'Doloshi', 'Benjinuri', 'Turbo'],
                'OpTic Gaming' => ['Clayster', 'Nadeshot', 'Scumpi', 'Mboze'],
                'Real AllStars' => ['DaReDeViL', 'Torres', 'Blackk', 'Bissell'],
                'Reign Mix' => ['IceManN', 'Reece', 'Joocy', 'Vizze'],
                'Rise Nation' => ['Fears', 'Whea7s', 'Pacman', 'Loony'],
                'SK Gaming' => ['RaidN', 'Kivii', 'Quickyy', 'Rockzz'],
                'Strictly Business' => ['Censor', 'Apathy', 'Saints', 'Dedo'],
                'Sublime' => ['Kolga', 'Pow3r', 'PiBo', 'Fridog'],
                'TCM Gaming' => ['Gunshy', 'MarkyB', 'Moose', 'MadCat'],
                'Team Kaliber' => ['Goonjar', 'Sharp', 'Theory', 'Formal'],
                'Team Orbit' => ['Jacko', 'Lewis', 'Bounce', 'Endrua'],
                'Team Rize' => ['Mance', 'Dominate', 'Reason', 'Pupsky'],
                'TEC Intensity' => ['Melo', 'Wonder', 'Realize', 'Robz'],
                'Trident T1dotters' => ['Iskatuu', 'Chilz', 'Denz', 'Damage'],
                'VexX Revenge' => ['Demon', 'Skill', 'Slumber', 'Mech'],
                'Vitality Returns' => ['Agonie', 'Azox', 'GetSome', 'dyluX'],
                'Vitality Rises' => ['Blue', 'Gotaga', 'Broken', 'Krnage'],
                'WiLD Gaming' => ['NexXx', 'Brock', 'Incepts', 'Anticity'],
                'Wizards' => ['TMac', 'Jorgeh', 'Kindok', 'Flexz'],
                'Xfinity Gaming' => ['Muddawg', 'Doubt', 'Sin', 'Crowster'],
            ],

            //ghosts g3
            "G3 Ghosts" => [
                'Evil Geniuses' => ['Aches', 'Teepee', 'Crimsix', 'Karma'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Neslo', 'Goonjar'],
                'Infused' => ['Joocy', 'Necrome', 'Luke', 'Joee'],
                'TCM' => ['MarkyB', 'Moose', 'Gunshy', 'Peatie'],
                'OpTic Nation' => ['Mboze', 'Killa', 'Mirx', 'Ricky'],
                'FaZe' => ['Censor', 'Parasite', 'Apathy', 'Dedo'],
                'Vitality' => ['Gotaga', 'Broken', 'Riskin', 'Krnage'],
                'EnVyUs' => ['Merk', 'Nameless', 'Formal', 'Jkap'],
                'OpTic Gaming' => ['Nadeshot', 'Scump', 'Clayster', 'Proofy'],
                'Exertus' => ['Robz', 'Reedy', 'Endura', 'Rated'],
                'Epsilon' => ['Jurd', 'Swanny', 'Tommey', 'Joshh'],
                'Curse' => ['Burnsoff', 'Mochila', 'Enable', 'Crowster'],
            ],

            //ghosts nashville
            "UMG Nashville Ghosts" => [
                'OpTic Nation' => ['Mboze', 'Ricky', 'KiLLa', 'MiRx'],
                'Evil Geniuses' => ['Aches', 'TeePee', 'Crimsix', 'Dedo'],
                'Denial' => ['Saints', 'Zooma', 'Studyy', 'Replays'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Neslo', 'Goonjar'],
                'FaZe' => ['Censor', 'Parasite', 'Karma', 'Apathy'],
                'OpTic Gaming' => ['Nadeshot', 'Clayster', 'Scump', 'Proofy'],
                'EnVyUs' => ['Merk', 'Jkap', 'Formal', 'Nameless'],
                'Most Wanted' => ['Spacely', 'Huhdle', 'Classic', 'Slacked'],
                'Curse' => ['Burnsoff', 'Mochila', 'Enable', 'Tipsy'],
                'Noble' => ['Sender', 'Miyagi', 'Chino', 'Slasher'],
                'Rise' => ['Pacman', 'Whea7s', 'Loony', 'Attach'],
                'Salvo' => ['Stainville', 'Gucci', 'Flawless', 'Saintt'],
                'STNNR' => ['Colechan', 'TJHaLy', 'PRPLXD', 'VeXeD'],
                'Aware' => ['Methodz', 'Jump', 'Baker', 'TCM'],
                'eXcellence' => ['KozMo', 'Diabolic', 'Blfire', 'Faccento'],
                'VexX' => ['Pluto', 'Jrich', 'Legal', 'FEARs'],
                'Carnage' => ['Huke', 'Vicious', 'Vein', 'Swirly'],
                'SiN' => ['Sin White 1', 'Sin White 2', 'Squizz', 'Sin White 4'],
            ],

            //ghosts s3_playoffs
            "Ghosts Season 3 Playoffs" => [
                'EnVyUs' => ['Merk', 'Nameless', 'Jkap', 'Formal'],
                'Rise' => ['Attach', 'Loony', 'Pacman', 'Whea7s'],
                'OpTic Gaming' => ['Nadeshot', 'Scump', 'Clayster', 'Proofy'],
                'OpTic Nation' => ['Mboze', 'Killa', 'Mirx', 'Ricky'],
                'FaZe' => ['Censor', 'Parasite', 'Karma', 'Apathy'],
                'Most Wanted' => ['Spacely', 'Huhdle', 'Slacked', 'Classic'],
                'Noble' => ['Chino', 'Sender', 'Miyagi', 'Slasher'],
                'Denial' => ['Replays', 'Saints', 'Zooma', 'Studyy'],
            ],

            //ghosts umg dallas
            "Ghosts UMG Dallas" => [
                'OpTic Nation' => ['Mboze', 'Ricky', 'KiLLa', 'MiRx'],
                'Team Kaliber' => ['Sharp', 'Goonjar', 'Theory', 'Neslo'],
                'OpTic Gaming' => ['Nadeshot', 'Scump', 'Clayster', 'Proofy'],
                'FaZe' => ['Censor', 'Apathy', 'Parasite', 'Dedo'],
                'EnVyUs' => ['Merk', 'Jkap', 'Formal', 'Nameless'],
                'Denial' => ['Zooma', 'Studyy', 'Saints', 'Replays'],
                'Curse' => ['Burnsoff', 'Mochila', 'Enable', 'Tipsy'],
                'Most Wanted' => ['Spacely', 'Huhdle', 'Classic', 'Slacked'],
                'Strictly Business' => ['Stainville', 'Methodz', 'John', 'Phizzurp'],
                'Vanquish' => ['Sender', 'Miyagi', 'Chino', 'Slasher'],
                'VexX' => ['Saintt', 'Muddawg', 'PLuTo', 'Jrich'],
                'Justus' => ['Twizz', 'Sin', 'Doubt', 'Blfire'],
                'Rise' => ['Attach', 'Whea7s', 'Loony', 'Pacman'],
                'Revenge' => ['iLLSkiLL', 'Slumber', 'Demon', 'Fuhlexer'],
                'Excellence' => ['Snipedown', 'Diabolic', 'KozMo', 'Faccento'],
                'Noble Black' => ['Lawless', 'TcM', 'Baker', 'Gucci'],
            ],

            //ghosts anahiem
            "Ghosts Anahiem" => [
                'Evil Geniuses' => ['Aches', 'Crimsix', 'Karma', 'TeePee'],
                'EnVyUs' => ['Merk', 'Nameless', 'Studyy', 'Parasite'],
                'OpTic Gaming' => ['Nadeshot', 'Scump', 'Clayster', 'Proofy'],
                'Epsilon' => ['Jurd', 'Swanny', 'Tommey', 'Joshh'],
                'TCM' => ['Moose', 'MarkyB', 'Peatie', 'Gunshy'],
                'FaZe Black' => ['Censor', 'Saints', 'Formal', 'Dedo'],
                'Curse Black' => ['Burnsoff', 'Mochila', 'Enable', 'Tipsy'],
                'FaZe Red' => ['Replays', 'Jkap', 'Theory', 'Classic'],
                'Curse AU' => ['Damage', 'Denz', 'Iskatuuu', 'Chilean'],
                'Denial' => ['Zooma', 'VeXeD', 'Legal', 'NoXiDe'],
                'Team Kaliber' => ['Sharp', 'Goonjar', 'Neslo', 'Apathy'],
            ],

            //ghosts s3 - need to manually input subs
            "Ghosts Season 3" => [
                'Evil Geniuses' => ['Aches', 'Crimsix', 'Teepee', 'Dedo'],
                'EnVyUs' => ['Merk', 'Nameless', 'Jkap', 'Formal'],
                'OpTic Gaming' => ['Nadeshot', 'Scump', 'Clayster', 'Proofy'],
                'Noble eSports' => ['Chino', 'Sender', 'Slasher', 'Miyagi'],
                'OpTic Nation' => ['Killa', 'Mirx', 'Mboze', 'Ricky'],
                'FaZe' => ['Censor', 'Apathy', 'Parasite', 'Karma'],
                'Curse' => ['Burnsoff', 'Mochila', 'Enable', 'Tipsy'],
                'Most Wanted' => ['Classic', 'Spacely', 'Huhdle', 'Slacked'],
                'Justus' => ['Twizz', 'Sin', 'Doubt', 'Blfire'],
                'Denial' => ['Zooma', 'Saints', 'Replays', 'Studyy'],
                'Team Kaliber' => ['Sharp', 'Goonjar', 'Neslo', 'Theory'],
                'Rise' => ['Pacman', 'Whea7s', 'Loony', 'Attach'],
            ],
        ];
    }

    public function getIWRosters() {
        return [
            "CWL 2017" => [
                //cwl 2017
                'EnVyUs' => ['Apathy', 'John', 'Jkap', 'SlasheR'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'Cloud9' => ['Aches', 'Assault', 'Lacefield', 'Ricky'],
                'Enigma6' => ['General', 'Kade', 'Proto', 'MRuiz'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'Fnatic' => ['Tommey', 'SunnyB', 'Skrapz', 'wuskin'],
                'Luminosity' => ['Saints', 'Classic', 'Slacked', 'Octane'],
                'Rise' => ['Loony', 'Aqua', 'Faccento', 'FeLonY'],
                'Mindfreak' => ['BuZZo', 'Fighta', 'Shockz', 'Excite'],
                'Epsilon' => ['Dqvee', 'Vortex', 'Hawqeh', 'Joshh'],
                'Red Reserve' => ['Joee', 'Urban', 'Niall', 'Seany'],
                'eLevate' => ['Zed', 'Watson', 'Reedy', 'Rated'],
                'millenium' => ['Peatie', 'MarkyB', 'Moose', 'Nolson'],
                'Splyce' => ['Bance', 'MadCat', 'Jurd', 'Zer0'],
                'Evil Geniuses' => ['NAMELESS', 'StuDyy', 'Havok', 'Nagafen'],
                'eUnited' => ['Gunless', 'Prestinni', 'Arcitys', 'SiLLY'],
            ],

            //anaheim 2017
            "Anahiem 2017" => [
                'EnVyUs' => ['Apathy', 'John', 'Jkap', 'SlasheR'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'Enigma6' => ['General', 'Kade', 'Proto', 'Royalty'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'Luminosity' => ['Saints', 'Classic', 'Slacked', 'Octane'],
                'Splyce' => ['Bance', 'MadCat', 'Jurd', 'Zero'],
                'Evil Geniuses' => ['NAMELESS', 'Parasite', 'Havok', 'Nagafen'],
                'eUnited' => ['Swarley', 'Prestinni', 'Arcitys', 'SiLLY'],
                'Rise Nation' => ['Loony', 'Aqua', 'Faccento', 'FeLonY'],
                'Epsilon' => ['Joshh', 'Dqvee', 'Hawqeh', 'Vortex'],
                'Elevate' => ['Zed', 'Watson', 'Reedy', 'Desire'],
                'Mindfreak' => ['BuZZO', 'Shockz', 'Fighta', 'Denz'],
                'Cloud9' => ['Aches', 'Xotic', 'Priest', 'Assault'],
                'Red Reserve' => ['Seany', 'Urban', 'Rated', 'Joee'],
                'Fnatic' => ['Tommey', 'SunnyB', 'Wuskin', 'Skrapz'],
                'BitterSweet' => ['Lacefield', 'Maux', 'LlamaGod', 'SpaceLy'],
            ],

            //gpl stage 2 iw
            "GPL Stage 2" => [
                'EnVyUs' => ['Apathy', 'John', 'Jkap', 'SlasheR'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'Cloud9' => ['Aches', 'Assault', 'Priest', 'Xotic'],
                'Enigma6' => ['General', 'Kade', 'Proto', 'Royalty'],
                'FaZe' => ['Gunless', 'Enable', 'Zoomaa', 'Attach'],
                'Fnatic' => ['Tommey', 'SunnyB', 'Skrapz', 'wuskin'],
                'Luminosity' => ['Saints', 'Classic', 'Slacked', 'Octane'],
                'Rise' => ['Loony', 'Aqua', 'Faccento', 'FeLonY'],
                'Mindfreak' => ['BuZZo', 'Fighta', 'Shockz', 'Denz'],
                'Epsilon' => ['Dqvee', 'Vortex', 'Hawqeh', 'Joshh'],
                'Red Reserve' => ['Joee', 'Urban', 'Rated', 'Seany'],
                'eLevate' => ['Zed', 'Watson', 'Reedy', 'Desire'],
                'Ghost Gaming' => ['Lacefield', 'Spacely', 'Maux', 'Llamagod'],
                'Splyce' => ['Bance', 'MadCat', 'Jurd', 'Zero'],
                'Evil Geniuses' => ['NAMELESS', 'Parasite', 'Havok', 'Nagafen'],
                'eUnited' => ['Clayster', 'Prestinni', 'Arcitys', 'SiLLY'],
            ],

            //gpl playoffs iw
            "GPL Playoffs" => [
                'EnVyUs' => ['Apathy', 'John', 'Jkap', 'SlasheR'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'Enigma6' => ['General', 'Kade', 'Proto', 'MRuiz'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'Luminosity' => ['Saints', 'Classic', 'Slacked', 'Octane'],
                'Splyce' => ['Bance', 'MadCat', 'Jurd', 'Zer0'],
                'Evil Geniuses' => ['NAMELESS', 'StuDyy', 'Havok', 'Nagafen'],
                'eUnited' => ['Gunless', 'Prestinni', 'Arcitys', 'SiLLY'],
            ],

            //dallas iw
            "MLG Dallas IW" => [
                'EnVyUs' => ['Apathy', 'John', 'Jkap', 'SlasheR'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'Cloud9' => ['Aches', 'Assault', 'Lacefield', 'Ricky'],
                'Enigma6' => ['General', 'Kade', 'Proto', 'MRuiz'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'Fnatic' => ['Tommey', 'SunnyB', 'Skrapz', 'wuskin'],
                'Luminosity' => ['Saints', 'Classic', 'Slacked', 'Octane'],
                'Rise' => ['Loony', 'Aqua', 'Faccento', 'FeLonY'],
                'Mindfreak' => ['BuZZo', 'Fighta', 'Shockz', 'Excite'],
                'Pnda' => ['FA5TBALLA', 'Pemby', 'ProFeezy', 'Prophet'],
                'Red Reserve' => ['Joee', 'Urban', 'Niall', 'Seany'],
                'eLevate' => ['Zed', 'Watson ', 'Reedy', 'Rated'],
                'millenium' => ['Peatie', 'MarkyB', 'Moose', 'Nolson'],
                'Splyce' => ['Bance', 'MadCat', 'Jurd', 'Zer0'],
                'Tainted Minds' => ['Nimble', 'Zeuss', 'Damage', 'Denz'],
                'eUnited' => ['Gunless', 'Prestinni', 'Arcitys', 'SiLLY'],
                'Team Kaliber' => ['Theory', 'ColeChan', 'Happy', 'Goonjar'],
                'GosuCrew' => ['DraMa', 'Maux', 'Priest', 'Xotic'],
                'SetToDestroyX' => ['Believe', 'Nova', 'Spoof', 'Mayhem'],
                'eRa Eternity' => ['Riviction', 'Nuglect', 'GodLike', 'Lyric'],
                'Evil Geniuses' => ['NAMELESS', 'StuDyy', 'Havok', 'Nagafen'],
                'Epsilon' => ['Dqvee', 'Vortex', 'Hawqeh', 'Joshh'],
                'G2' => ['SpaceLy', 'Chino', 'Accuracy', 'Pacman'],
            ],
        ];

    }

    public function getAWRosters() {
        return [
            //xgames 2015 aw
            "XGames 2015" => [
                'OpTic Gaming' => ['Karma', 'Crimsix', 'Scump', 'Formal'],
                'Denial' => ['Clayster', 'Attach', 'Replays', 'Jkap'],
                'FaZe' => ['Huke', 'Slasher', 'Enable', 'Zooma'],
                'eLevate' => ['Temp', 'Slacked', 'TJHaLy', 'Classic'],
                'EnVyUs' => ['Saints', 'Proofy', 'Loony', 'Teepee'],
                'Team Kaliber' => ['Parasite', 'Sharp', 'Goonjar', 'Nameless'],
                'TCM Gaming' => ['Moose', 'Madcat', 'Jurd', 'Shane'],
                'Rise Nation' => ['Neslo', 'Theory', 'Whea7s', 'Chino'],
            ],

            //umgdc aw
            "UMG DC AW" => [
                'EnVyUs' => ['Loony', 'AquA', 'Jkap', 'Octane'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mboze', 'Mochila', 'MiRx', 'Ricky'],
                'Epsilon' => ['Remy', 'Nagafen', 'Parasite', 'Royalty'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'iSolation' => ['Dedo', 'Havok', 'SiLLY', 'LlamaGod'],
                'VexX' => ['Proto', 'Holler', 'Prophet', 'FA5T'],
                'Rise' => ['Apathy', 'Whea7s', 'Burnsoff', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Nameless', 'Neslo'],
                'TCM Gaming' => ['Aches', 'Teepee', 'Fears', 'Jurd'],
                'XGN' => ['Phizzurp', 'KiLLa', 'StuDyy', 'Lacefield'],
                'eLevate' => ['Slacked', 'Classic', 'TJHaLy', 'Saints'],
                'Enigma6' => ['General', 'John', 'Proofy', 'FeLo'],
                'Onslaught' => ['Chawn', 'Murica', 'Proodian', 'TipToe'],
                'Orbit' => ['Faccento', 'Accuracy', 'TcM', 'Happy'],
                'Denial' => ['Replays', 'Temp', 'Huke', 'SlasheR'],
                'Lethal Gaming' => ['Riviction', 'Nuglect', 'Fox', 'Lyric'],
                'Vanquish' => ['Profeezy', 'Pemby', 'GodRx', 'Demise'],
                'JusTus' => ['Kenny', 'Spacely', 'Assault', 'Envoy'],
                'STNNR' => ['Baker', 'Jump', 'PRPLXD', 'Swarley'],
            ],

            //umg dallas aw
            "UMG DALLAS AW" => [
                'EnVyUs' => ['Loony', 'AquA', 'Jkap', 'Octane'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mboze', 'Mochila', 'MiRx', 'Ricky'],
                'Epsilon' => ['Remy', 'Nagafen', 'Swanny', 'Royalty'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'iSolation' => ['Dedo', 'Havok', 'SiLLY', 'GodRx'],
                'Dunkin No Donuts' => ['Derpin', 'Eleiviate', 'Human', 'Nova'],
                'Rise' => ['TJHaLy', 'Whea7s', 'TcM', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Nameless', 'Neslo'],
                'TCM Gaming' => ['Aches', 'Teepee', 'Moose', 'Jurd'],
                'XGN' => ['SpaceLy', 'KiLLa', 'StuDyy', 'Goonjar'],
                'eLevate' => ['Slacked', 'Classic', 'Apathy', 'Saints'],
                'Enigma6' => ['General', 'Mruiz', 'Parasite', 'Proofy'],
                'Rod Squad' => ['Nelson', 'Assauhlt', 'Wolf', 'Ken'],
                'iSo' => ['Dedo', 'Havok', 'SiLLY', 'GoDRx'],
                'vVv' => ['Phizzurp', 'John', 'FeLonY', 'FEARS'],
                'Denial' => ['Replays', 'Temp', 'Huke', 'SlasheR'],
                'Tactical Turtles' => ['Kade', 'ExiB', 'Copier', 'Grizzly'],
                'Mutiny' => ['Riviction', 'Nuglet', 'Lyric', 'Demise'],
                'G4G' => ['Simple', 'Cells', 'Envoy', 'Evasion'],
                'Rampage Black' => ['KlinK', 'Aspect', 'Instinctz', 'Mouser'],
            ],

            //umg cali aw
            "UMG Cali AW" => [
                'EnVyUs' => ['Saints', 'Loony', 'TeePee', 'Proofy'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mboze', 'KiLLa', 'MiRx', 'Ricky'],
                'Justus' => ['Merk', 'Octane', 'StuDyy', 'TcM'],
                'FaZe' => ['ZooMa', 'Enable', 'Slasher', 'Huke'],
                'vVv' => ['Phizzurp', 'TwiZz', 'Sin', 'John'],
                'Prophecy' => ['Aches', 'Nagafen', 'AquA', 'Apathy'],
                'Rise' => ['Neslo', 'Whea7s', 'Theory', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Goonjar', 'Nameless', 'Parasite'],
                'Below Zero' => ['Wolf', 'GodLike', 'Swarley', 'Assauhlt'],
                'VexX' => ['Fastball', 'Prophet', 'Reck', 'Jsano'],
                'eLevate' => ['Temp', 'Replays', 'TJHaLy', 'Classic'],
                '3sUp' => ['CaLiFa', 'Strife', 'Sender', 'Diabolic'],
                'Automatic Reload' => ['Spacely', 'Burnsoff', 'Mochila', 'Anticity'],
                'iSo' => ['Dedo', 'Havok', 'LlamaGod', 'Silly'],
                'Orbit' => ['Faccento', 'Happy', 'Lawless', 'Accuracy'],
                'Enigma6' => ['Jgeneral', 'Kade', 'ExiB', 'Mruuiz'],
                'Ignite' => ['Saintt', 'Miyagi', 'Dimi', 'Aries'],
                'Dream Team' => ['Baker', 'GodRx', 'Vicious', 'Stringo'],
                'XGN' => ['Pacman', 'Colechan', 'Blfire', 'Felo'],
            ],

            //s3 relegation aw
            "Season 3 Relegation AW" => [
                'Automatic Reload' => ['Blfire', 'FeLonY', 'Lawless', 'Merk'],
                'Enigma6' => ['General', 'Mruuiz', 'Proto', 'Holler'],
                'OpTic Nation' => ['Mboze', 'Mochila', 'MiRx', 'Ricky'],
                'Prophecy' => ['Aches', 'Apathy', 'AquA', 'Octane'],
                '3sUp' => ['Strife', 'CaLiFa', 'Diabolic', 'Sender'],
                'dT Blue' => ['Swarley', 'Assauhlt', 'FEARS', 'Jump'],
                'Epsilon eSports' => ['Swanny', 'Remy', 'Nagafen', 'Royalty'],
                'iSolation' => ['Dedo', 'LlamaGod', 'Havok', 'SiLLY'],
                'Strictly Business' => ['Anticity', 'Spacely', 'Studyy', 'TcM'],
                'SYNRGY' => ['Ivy', 'Legal', 'Pacman', 'Miyagi'],
                'Orbit' => ['Accuracy', 'Faccento', 'Happy', 'Burnsoff'],
                'vVv' => ['Phizzurp', 'John', 'TwiZz', 'KiLLa'],
                'dT Purple' => ['Fox', 'Baker', 'Dimi', 'Stringo'],
                'Geared 4 Gaming' => ['Simplee', 'Cells', 'DylPickle', 'Envoy'],
                'Mutiny' => ['Riviction', 'Nuglect', 'Lacefield', 'Bnelson'],
                'VexX' => ['Prophet', 'FA5TBALLA', 'Aries', 'Vicious'],
            ],

            //s3 playoffs aw
            "Season 3 Playoffs AW" => [
                'EnVyUs' => ['Aqua', 'Loony', 'Octane', 'Jkap'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mirx', 'Mboze', 'Ricky', 'Mochila'],
                'Epsilon' => ['Remy', 'Parasite', 'Nagafen', 'Royalty'],
                'FaZe' => ['Clayster', 'Enable', 'Attach', 'ZooMa'],
                'Denial' => ['Slasher', 'Replays', 'Temp', 'Huke'],
                'Orbit' => ['TcM', 'Happy', 'Faccento', 'Accuracy'],
                'Rise' => ['Apathy', 'Whea7s', 'Burnsoff', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Nameless', 'Neslo'],
                'iSolation' => ['Dedo', 'SiLLY', 'LlamaGod', 'Havok'],
                'TCM Gaming' => ['Fears', 'Jurd', 'Aches', 'TeePee'],
                'eLevate' => ['Classic', 'Saints', 'TJHaLy', 'Slacked'],
            ],

            //mlg worlds aw
            "MLG Worlds AW" => [
                'EnVyUs' => ['Loony', 'Jurd', 'Jkap', 'Goonjar'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mboze', 'Nameless', 'MiRx', 'Ricky'],
                'Epsilon' => ['Remy', 'Nagafen', 'Parasite', 'Aqua'],
                'FaZe' => ['Clayster', 'Enable', 'Zooma', 'Attach'],
                'iSolation' => ['Dedo', 'Havok', 'SiLLY', 'LlamaGod'],
                'Vitality' => ['Tommey', 'Swanny', 'Madcat', 'Joee'],
                'Rise' => ['Aches', 'Whea7s', 'Burnsoff', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Apathy', 'Neslo'],
                'Millenium' => ['Gotaga', 'Rated', 'Reedy', 'Moose'],
                'XGN' => ['Phizzurp', 'KiLLa', 'StuDyy', 'FeLonY'],
                'eLevate' => ['Slacked', 'Octane', 'TJHaLy', 'Saints'],
                'infused' => ['Urban', 'MarkyB', 'Zero', 'Peatie'],
                'Citadel' => ['Hoju', 'DizmuLL', 'Lakie', 'Carry'],
                'Orbit' => ['Faccento', 'Replays', 'TcM', 'Happy'],
                'Denial' => ['Classic', 'Temp', 'Huke', 'SlasheR'],
                'Justus' => ['Spacely', 'Kenny', 'Envoy', 'Assauhlt'],
                'Thrust' => ['Royalty', 'Mochila', 'Lacefield', 'Fears'],
                'Lethal' => ['Holler', 'Proto', 'Kade', 'Mruiz'],
                'dT' => ['Sender', 'Ivy', 'Watson', 'Diabolic'],
            ],

            //mlg s3 aw
            "MLG Season 3 AW" => [
                'EnVyUs' => ['Aqua', 'Loony', 'Octane', 'Jkap'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mirx', 'Mboze', 'Ricky', 'Mochila'],
                'Epsilon' => ['Remy', 'Swanny', 'Nagafen', 'Royalty'],
                'FaZe' => ['Clayster', 'Enable', 'Attach', 'ZooMa'],
                'Denial' => ['Slasher', 'Replays', 'Temp', 'Huke'],
                'Orbit' => ['TcM', 'Happy', 'Faccento', 'Accuracy'],
                'Rise' => ['Apathy', 'Whea7s', 'Burnsoff', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Nameless', 'Neslo'],
                'iSolation' => ['Dedo', 'SiLLY', 'LlamaGod', 'Havok'],
                'TCM Gaming' => ['Moose', 'Jurd', 'Aches', 'TeePee'],
                'eLevate' => ['Classic', 'Saints', 'TJHaLy', 'Slacked'],
            ],

            //gfinity summer aw
            "Gfinity Summer AW" => [
                'EnVyUs' => ['Aqua', 'Loony', 'Octane', 'Jkap'],
                'OpTic Gaming' => ['Karma', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mirx', 'Mboze', 'Ricky', 'Mochila'],
                'Epsilon EU' => ['Rated', 'Reedy', 'Joee', 'Madcat'],
                'FaZe' => ['Clayster', 'Enable', 'Attach', 'ZooMa'],
                'Vitality' => ['Joshh', 'Watson', 'Peatie', 'Tommey'],
                'Infused' => ['Urban', 'MarkyB', 'QwiKeR', 'LXT'],
                'Rise' => ['Apathy', 'Whea7s', 'Burnsoff', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Theory', 'Nameless', 'Neslo'],
                'HyperGames' => ['Maxxie', 'Vezio', 'Tonyjs', 'Melo'],
                'TCM Gaming' => ['Moose', 'Jurd', 'Aches', 'TeePee'],
                'eLevate' => ['Classic', 'Replays', 'Slasher', 'Slacked'],
                'IGI eSports' => ['Sowerz', 'Harley', 'vapeZ', 'Camboo'],
                'Liquid' => ['Pibo', 'Duke', 'Ko1gaa', 'Donnyy'],
                'Spirit Gaming' => ['EupHo', 'FlexZ', 'Pelukaa', 'Sammy'],
                'VwS' => ['Jake', 'Realize', 'SunnyB', 'Nolson'],
            ],

            //gfinity aw
            "Gfinity AW" => [
                'EnVyUs' => ['Merk', 'Loony', 'Teepee', 'Proofy'],
                'OpTic Gaming' => ['Enable', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mboze', 'KiLLa', 'MiRx', 'Ricky'],
                'Mindfreak' => ['Denz', 'Fighta', 'Shockz', 'Buzzin'],
                'fabE Germany' => ['Gunelite', 'Kivi', 'Rush', 'Torres'],
                'Denial' => ['Attach', 'Clayster', 'Replays', 'Jkap'],
                'Prophecy' => ['AquA', 'Nagafen', 'Aches', 'Apathy'],
                'Epsilon' => ['Remy', 'Madcat', 'Swanny', 'Faccento'],
                'Team Kaliber' => ['Sharp', 'Goonjar', 'Nameless', 'Parasite'],
                'HyperGames' => ['Tonyjs', 'Veziok', 'Azok', 'Riskin'],
                'Aware Gaming' => ['Joee', 'Peatie', 'Watson', 'Rated'],
                'Vitality Storm' => ['Tommey', 'Reedy', 'MarkyB', 'Joshh'],
                'Infused' => ['QwiKer', 'MeLoN', 'Lewis', 'Jtee'],
                'Strictly Business' => ['Phizzurp', 'TwiZz', 'John', 'SinfuL'],
                'TCM Gaming' => ['Moose', 'Gunshy', 'ShAnE', 'Jurd'],
                'Gamers2' => ['jk7', 'Lgnd', 'peLukaa', 'MethodZ'],
            ],

            //coLumbus aw 
            "Columbus AW" => [
                'EnVyUs' => ['Merk', 'Nameless', 'Jkap', 'Clayster'],
                'OpTic Gaming' => ['Nadeshot', 'Formal', 'Scump', 'Crimsix'],
                'OpTic Nation' => ['Mboze', 'Karma', 'Teepee', 'Proofy'],
                'Justus' => ['Mochila', 'Classic', 'Slacked', 'Enable'],
                'FaZe' => ['Censor', 'Apathy', 'Slasher', 'Aches'],
                'Denial' => ['Saints', 'Replays', 'ZooMa', 'Attach'],
                'Carnage' => ['Huke', 'Vicious', 'Vain', 'Swarley'],
                'Rise' => ['Pacman', 'Whea7s', 'Diabolic', 'Chino'],
                'Team Kaliber' => ['Sharp', 'Goonjar', 'Theory', 'Loony'],
                'Prophecy' => ['Ricky', 'Legal', 'Parasite', 'Fears'],
                'Strictly Business' => ['Phizzurp', 'Twizz', 'John', 'Sin'],
                'StDx Esport' => ['TuQuick', 'Nihill', 'Nelson', 'LynxX'],
                'Automatic Reload' => ['Tipsy', 'Burnsoff', 'Felony', 'Blfire'],
                'Lucky Strike' => ['Gucci', 'Stainville', 'Realize', 'Saintt'],
                'Aware Gaming' => ['Sender', 'happy', 'Lawless', 'Accuracy'],
                'STNNR' => ['Colechan', 'TJHaLy', 'PRPLXD', 'VeXeD'],
            ],
        ];
    }
    public function getAllTeams() {
        $teamNames = [
            'G4G',
            'SiN',
            'Real AllStars',
            'Lethal Gaming',
            'JusTus',
            'Tactical Turtles',
            'Evil Geniuses',
            'EnVyUs',
            'OpTic Gaming',
            'Epsilon',
            'TCM',
            'FaZe Black',
            'Curse Black',
            'FaZe Red',
            'Curse AU',
            'Denial',
            'Team Kaliber',
            'EnVyUs',
            'Rise',
            'Curse',
            'OpTic Gaming',
            'Evil Geniuses',
            'FaZe',
            'Denial',
            'OpTic Nation',
            'Team Kaliber',
            'Justus',
            'Noble eSports',
            'Most Wanted',
            'OpTic Nation',
            'Team Kaliber',
            'OpTic Gaming',
            'FaZe',
            'EnVyUs',
            'Denial',
            'Curse',
            'Most Wanted',
            'Strictly Business',
            'Vanquish',
            'VexX',
            'Justus',
            'Rise',
            'Revenge',
            'Excellence',
            'Noble Black',
            'EnVyUs',
            'Rise',
            'OpTic Gaming',
            'OpTic Nation',
            'FaZe',
            'Most Wanted',
            'Noble',
            'Denial',
            'OpTic Nation',
            'Evil Geniuses',
            'Denial',
            'Team Kaliber',
            'FaZe',
            'OpTic Gaming',
            'EnVyUs',
            'Most Wanted',
            'Curse',
            'Noble',
            'Rise',
            'Salvo',
            'Aware',
            'STNNR',
            'eXcellence',
            'VexX',
            'Carnage',
            'Evil Geniuses',
            'Team Kaliber',
            'Infused',
            'TCM',
            'OpTic Nation',
            'FaZe',
            'Vitality',
            'EnVyUs',
            'OpTic Gaming',
            'Exertus',
            'Epsilon',
            'Curse',
            'compLexity',
            'Team Kaliber',
            'Rise Nation',
            'EnVyUs',
            'OpTic Gaming',
            'FaZe',
            'Strictly Business',
            'Xfinity Gaming',
            'VexX Revenge',
            'WiLD Gaming',
            'Aztek Gaming',
            'Brazil 5 Stars',
            'TCM Gaming',
            'Epsilon Esports',
            'TEC Intensity',
            'Team Orbit',
            'Vitality Rises',
            'Vitality Returns',
            'Killerfish',
            'SK Gaming',
            'Sublime',
            'Lightning Pandas',
            'Benelux',
            'Wizards',
            'Reign Mix',
            'Immunity',
            'Trident T1dotters',
            'Team Rize',
            'Klarity Team',
            'Nsp',
            'Echelon',
            'Evil Geniuses',
            'EnVyUs',
            'OpTic Gaming',
            'Epsilon',
            'TCM',
            'FaZe Black',
            'Curse Black',
            'FaZe Red',
            'Curse AU',
            'Denial',
            'Team Kaliber',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Justus',
            'FaZe',
            'Denial',
            'Rise',
            'Team Kaliber',
            'Prophecy',
            'Strictly Business',
            'Carnage',
            'Automatic Reload',
            'Lucky Strike',
            'Aware Gaming',
            'StDx Esport',
            'STNNR',
            'Noble Impact',
            'Orbit',
            'Vitality',
            'Dt Esport',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Justus',
            'FaZe',
            'Denial',
            'Rise',
            'Team Kaliber',
            'Prophecy',
            'Strictly Business',
            'Carnage',
            'Automatic Reload',
            'Lucky Strike',
            'Aware Gaming',
            'StDx Esport',
            'STNNR',
            'Noble Impact',
            'Orbit',
            'Vitality',
            'Dt Esport',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Epsilon',
            'FaZe',
            'iSolation',
            'Rise',
            'Team Kaliber',
            'Onslaught',
            'Enigma6',
            'vVv',
            'eLevate',
            'XGN',
            'Denial',
            'TCM Gaming',
            'VexX',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Epsilon',
            'FaZe',
            'iSolation',
            'Rise',
            'Team Kaliber',
            'Rod Squad',
            'Enigma6',
            'vVv',
            'eLevate',
            'XGN',
            'Denial',
            'TCM Gaming',
            'Dunkin No Donuts',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Justus',
            'FaZe',
            'vVv',
            'Rise',
            'Team Kaliber',
            'Prophecy',
            'Below Zero',
            'VexX',
            'eLevate',
            '3sUp',
            'Orbit',
            'iSo',
            'Automatic Reload',
            'enigma6',
            'Automatic Reload',
            'Enigma6',
            'OpTic Nation',
            'Prophecy',
            '3sUp',
            'dT Blue',
            'Epsilon eSports',
            'iSolation',
            'Strictly Business',
            'SYNRGY',
            'Orbit',
            'vVv',
            'dT Purple',
            'Geared 4 Gaming',
            'Mutiny',
            'VexX',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Epsilon',
            'FaZe',
            'Denial',
            'Rise',
            'Team Kaliber',
            'Orbit',
            'iSolation',
            'TCM Gaming',
            'eLevate',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Epsilon',
            'FaZe',
            'iSolation',
            'Rise',
            'Team Kaliber',
            'Vitality',
            'Millenium',
            'infused',
            'eLevate',
            'XGN',
            'Denial',
            'Citadel',
            'Orbit',
            'Justus',
            'Thrust',
            'Lethal',
            'dT',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Epsilon',
            'FaZe',
            'Denial',
            'Rise',
            'Team Kaliber',
            'Orbit',
            'iSolation',
            'TCM Gaming',
            'eLevate',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Epsilon EU',
            'FaZe',
            'Vitality',
            'Rise',
            'Team Kaliber',
            'Infused',
            'HyperGames',
            'TCM Gaming',
            'eLevate',
            'IGI eSports',
            'Liquid',
            'Spirit Gaming',
            'VwS',
            'EnVyUs',
            'OpTic Gaming',
            'OpTic Nation',
            'Mindfreak',
            'fabE Germany',
            'Denial',
            'Epsilon',
            'Team Kaliber',
            'Prophecy',
            'HyperGames',
            'Vitality Storm',
            'Infused',
            'TCM Gaming',
            'Aware Gaming',
            'Strictly Business',
            'Gamers2',
            'EnVyUs',
            'OpTic Gaming',
            'Cloud9',
            'Enigma6',
            'FaZe',
            'Rise',
            'Luminosity',
            'eLevate',
            'Red Reserve',
            'Fnatic',
            'Splyce',
            'eUnited',
            'Millenium',
            'Mindfreak',
            'Enigma6',
            'Pnda',
            'Tainted Minds',
            'Ghost Gaming',
        ];
        return $teamNames;
    }
    public function getAllPlayers() {
        $aliases = [
            'Aspect',
            'Instinctz',
            'KlinK',
            'Accuracy',
            'Aches',
            'Afro',
            'Agonie',
            'Andy',
            'Anticity',
            'Apathy',
            'Aqua',
            'AquA',
            'Arcitys',
            'Aries',
            'Artshot',
            'Assassin',
            'Assauhlt',
            'Assault',
            'Attach',
            'Aykon',
            'AyKon',
            'aziz',
            'Azok',
            'Azox',
            'Baker',
            'Bance',
            'Beehzy',
            'Believe',
            'Benjinuri',
            'BigTymer',
            'Bissaroo',
            'Bissell',
            'Blackk',
            'Blackk KF',
            'BLaQkRoW',
            'Blfire',
            'Blue',
            'Bnelson',
            'Bounce',
            'Bound',
            'Braaain',
            'Brock',
            'Broken',
            'Burnsoff',
            'Buzzin',
            'Buzzo',
            'BuZZo',
            'BuZZO',
            'CaLiFa',
            'Carry',
            'Cball',
            'Cells',
            'Censor',
            'Chawn',
            'Chilean',
            'Chilz',
            'Chino',
            'Classic',
            'Clayster',
            'Clumzy',
            'Coco',
            'Colechan',
            'ColeChan',
            'Copier',
            'Crimsix',
            'Crowster',
            'Cypher',
            'Damage',
            'DareDeViL',
            'DaReDeViL',
            'Dashy',
            'Dedo',
            'Demise',
            'Demon',
            'Denz',
            'Derpin',
            'Desire',
            'Diabolic',
            'Dimi',
            'DizmuLL',
            'Doloshi',
            'Dominate',
            'Donnyy',
            'Doubt',
            'Dqvee',
            'DraMa',
            'Dt 1',
            'Dt 3',
            'Dt 4',
            'Duke',
            'DylPickle',
            'dyluX',
            'Dynamic',
            'Eleiviate',
            'Enable',
            'Endrua',
            'Endura',
            'Envoy',
            'EupHo',
            'Evasion',
            'Excite',
            'ExiB',
            'FA5T',
            'FA5TBALLA',
            'Faccento',
            'Fastball',
            'Fears',
            'FEARs',
            'FEARS',
            'Felo',
            'FeLo',
            'Felony',
            'FeLonY',
            'Fighta',
            'Flawless',
            'Flexz',
            'FlexZ',
            'Flux',
            'Formal',
            'Fox',
            'Fridog',
            'Fuhlexer',
            'General',
            'Getsom',
            'GetSome',
            'GodLike',
            'GodRx',
            'GoDRx',
            'Goonjar',
            'Gotaga',
            'Grizzly',
            'Groundser',
            'Gucci',
            'Gunelite',
            'Gunless',
            'Gunshy',
            'H',
            'happy',
            'Happy',
            'Harley',
            'Hasbroken',
            'HasBroken',
            'Hate',
            'Havok',
            'Hawqeh',
            'Hec',
            'Historify',
            'Hoju',
            'Holler',
            'Huhdle',
            'Huke',
            'Human',
            'HumanJesus',
            'IceManN',
            'iLLSkiLL',
            'Impulse',
            'Incepts',
            'Iskatuu',
            'Iskatuuu',
            'Ivy',
            'Jacko',
            'Jake',
            'Jgeneral',
            'jk7',
            'Jkap',
            'Joee',
            'John',
            'Johnny',
            'Joocy',
            'Jorgeh',
            'JorGeh',
            'Joshh',
            'Jrich',
            'Jsano',
            'Jtee',
            'Juju',
            'Jump',
            'Jurd',
            'Kade',
            'Karma',
            'Ken',
            'Kenny',
            'Killa',
            'KiLLa',
            'Kindok',
            'KiNDoK',
            'Kivi',
            'Kivii',
            'Klink',
            'Ko1gaa',
            'Kolga',
            'Kozmo',
            'KozMo',
            'Krnage',
            'Lacefield',
            'Lakie',
            'Lawless',
            'Le',
            'Legal',
            'Lewis',
            'Lgnd',
            'Llamagod',
            'LlamaGod',
            'Loony',
            'Luke',
            'Lukman',
            'LXT',
            'LynxX',
            'Lyric',
            'Madcat',
            'MadCat',
            'Mance',
            'MarkyB',
            'Maux',
            'Maxxie',
            'Mayhem',
            'Mboze',
            'Mech',
            'Melo',
            'MeLoN',
            'Merk',
            'Methodz',
            'MethodZ',
            'Mirx',
            'MiRx',
            'MiRX',
            'Miyagi',
            'Mochila',
            'Moose',
            'MoToD',
            'Mruiz',
            'MRuiz',
            'Mruuiz',
            'Muddawg',
            'Murica',
            'Nadeshot',
            'Nagafen',
            'Naked',
            'Nameless',
            'NAMELESS',
            'Necrome',
            'Nelson',
            'NeoZDaBestia',
            'Neslo',
            'NexXx',
            'Niall',
            'Nihill',
            'Nimble',
            'Nolson',
            'Nova',
            'Noxide',
            'NoXiDe',
            'Nuglect',
            'Nuglet',
            'Octane',
            'Pacman',
            'Pandur',
            'Parasite',
            'Peatie',
            'peLukaa',
            'Pelukaa',
            'Pemby',
            'Phaze',
            'Phizzurp',
            'Pibo',
            'PiBo',
            'Pluto',
            'PLuTo',
            'Pow3r',
            'POW3R',
            'Prestinni',
            'Priest',
            'Profeezy',
            'ProFeezy',
            'Proodian',
            'Proofy',
            'Prophet',
            'Proto',
            'PRPLXD',
            'Pupsky',
            'Quickyy',
            'QwiKer',
            'QwiKeR',
            'QxiCky',
            'RaidN',
            'Ramba',
            'Rambo',
            'Rampage',
            'Randm',
            'Rated',
            'Realize',
            'Reason',
            'Reck',
            'Reece',
            'Reedy',
            'Rem1xaa',
            'Remy',
            'Replays',
            'Revan',
            'Ricky',
            'Riskin',
            'Riviction',
            'Robz',
            'Rockzz',
            'Royalty',
            'rskN',
            'Rush',
            'Saints',
            'Saintt',
            'Sammy',
            'Scump',
            'Scumpi',
            'Seany',
            'Sender',
            'Shane',
            'ShAnE',
            'Sharp',
            'Shipping',
            'Shockz',
            'Silly',
            'SiLLY',
            'Simple',
            'Simplee',
            'Sin',
            'Sinful',
            'SinfuL',
            'Sin White 1',
            'Sin White 2',
            'Sin White 4',
            'Skill',
            'SkittleZ',
            'Skrapz',
            'Slacked',
            'Slasher',
            'SlasheR',
            'Slumber',
            'Snipedown',
            'Sowerz',
            'Spacely',
            'SpaceLy',
            'Spoof',
            'Squizz',
            'Stainville',
            'Stamino',
            'Strife',
            'Stringo',
            'Study',
            'Studyy',
            'StuDyy',
            'SunnyB',
            'Swanny',
            'Swarley',
            'Swirly',
            'Syns',
            'TcM',
            'TCM',
            'Teepee',
            'TeePee',
            'Temp',
            'Theory',
            'Theros',
            'Thing2',
            'Tipsy',
            'TipToe',
            'TJHaLy',
            'TMac',
            'T Mac',
            'Tommey',
            'Tonyjs',
            'Torres',
            'TuQuick',
            'Turbo',
            'Twizz',
            'TwiZz',
            'Urban',
            'Vain',
            'vapeZ',
            'Vein',
            'VeXeD',
            'Vezio',
            'Veziok',
            'Vicious',
            'Vizze',
            'Vortex',
            'Wailers',
            'Watson',
            'Weeman',
            'Whea7s',
            'Wolf',
            'Wonder',
            'wuskin',
            'Wuskin',
            'XLNC',
            'Xotic',
            'Zed',
            'Zer0',
            'Zero',
            'Zeuss',
            'Zooma',
            'ZooMa',
            'Zoomaa',
        ];
        return $aliases;
    }
};
