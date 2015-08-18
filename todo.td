Refactor GameController store method
 Store game/match, then hand off to the modecontrollers to store

host in createSnd

in leaderboardcontroller@viewbyevent, don't use all players -- just the ones
who are on rosters that were added to that event. this also means we have to
add rosters to events, and have a manage thing. also, maybe add something 
on event.php to return the list of players at that event 
a roster_event class and model have been created -- still needs a controller
for basic rest stuff

add caching in leaderboardcontroller@viewbyevent

if something is nulled (ex hp kills), when editing map it should be
blank, not 0

Create real email and put it in suercontroller mail sender

Add getters for team round stats in App\Snd. Find list in remove_round_stats 
migration. Added a rounds getter, perhaps do the team stats in sndcontroller?

make game number something that is entered and edited

Put snd migrations back into migrations folder(when fixed)

Add game_number controls to edit stuff, also move all the time divs to a partial

add host stuff back in

Game shouldn't have score_type column, that's for match

Update migration for snd stuff
 We have lms and fb_wins
 foreach player, 1o

For creating snd (and all games) select each primary player by default


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

