Refactor GameController store method
 Store game/match, then hand off to the modecontrollers to store

Create real email and put it in suercontroller mail sender

For caching, cache the smaller parts as we go along so eventually we
don't need to cache full views (when this happens we can add back the
admin and logout links to all pages)

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
uplink kills * 1.1
uplink deaths * -.8
snd kills * 2
snd deaths * -1.2
hp caps 1
hp defends 1
uplink points 3
snd plants 3
