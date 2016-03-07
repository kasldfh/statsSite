high priority
    frontend/event.blade.php shoudl really be event-standings.blade.php
    figure out navigation for event pages
    figure out bakcgrounds for event pages
    recalculate map count in update game modes
    figure out fix for ctf scores stuff
    is ul dunks properly working?
    images for events teams players

Medium Priority:
    most recent game in title of frontend/events.blade.php
    when I click on a different game title nothing shows up in frontend/events/blade.php
who are on rosters that were added to that event. 
    add caching in leaderboardcontroller@viewbyevent

low priority
    for hp time, show 2 digits consistently
    when creating a match, only show rosters that are at that event
    fix host stuff in modecontrollers shoudl be quick
    Create real email and put it in suercontroller mail sender
    Refactor GameController store method
        Store game/match, then hand off to the modecontrollers to store
    Refactor all the migrations to use ->increments instead of integer(id, true)
    add match type for bracket so we can compare bracket/pool stats for players

busywork
    finish properly indenting snd.blade.php



make all the model deletion properly cascade...maybe even properly set up foreigh keys
match
 game
  mode
   player
   round (snd)
team
 rosters
event
 matches

Notes:



not sure if this is needed but possibly add a getAtEvent($id) 
attribute to roster model instead of doing that logic in the 
controller

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

Ctf maps to fix: 
http://104.236.216.23/admin/ctf/215/edit
http://104.236.216.23/admin/ctf/256/edit

same score, 1 was added to winner
