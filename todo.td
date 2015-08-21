Refactor GameController store method
 Store game/match, then hand off to the modecontrollers to store

in leaderboardcontroller@viewbyevent, don't use all players -- just the ones
who are on rosters that were added to that event. 

add caching in leaderboardcontroller@viewbyevent

make all the model deletion delete dependencies
match
 game
  mode
   player
   round (snd)
team
 rosters
event
 matches


when creating a match, only show rosters that are at that event

Create real email and put it in suercontroller mail sender

For creating games select each primary player by default
 Actually, is this a good idea? Make people enter players manually so there's
 a distinction when a player wasn't at a game

map count for manage events isn't updating, how is that being calculated?

Notes:
Do I actually need the event_source stuff?
 Could, if we need to handle snd from excel events differently than snd from
     inputted events....
//update statuploader to include snd stats, do like this for player snd stats

    //first, make a "stack" of fb's and lms's. 
    //order doesn't matter, because these aren't "real rounds"
    $fbs = [];
    $lms = [];
    foreach($players as $player)
    {
        foreach($player->fb)
            $fbs[] = $player->id
        foreach($player->lms)
            $lms[] = $player->id
    }
    for(i = 0; i < max(fbs.size, lms.size); i++)
    {
        $round = new SndRound;
        $round->snd_id = gameid;
        $round->round_num = [i];
        if(isset(fbs[i])
            $round->fb_player_id = $fbs[i]
        if(isset(lms[i])
            $round->lms_player_id = $lms[i]
        $round->save
    }

formula for vulcun
hp kills * 1
hp deaths * .6
hp caps 1
hp defends 1

uplink kills * 1.1
uplink deaths * -.8
uplink points 3

snd plants 3
snd kills * 2
snd deaths * -1.2


Add something liek this for the bans/picks/protects
so im thinking it'll look like this
pick 1 | player | ban/pro | thing | weapon used | specialist used| whatever else|
.....
pick 8

not sure if this is needed but possibly add a getAtEvent($id) 
attribute to roster model instead of doing that logic in the 
controller

