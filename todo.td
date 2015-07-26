Refactor SndRound stuff
 Store player round stats (lms/fb/lmsW/fbW) in rounds only
  Remove these stats from SndPlayer(already stored in sndRound)
 Store team round stats (o/dW, plant/plantW)
  Remove these stats from Snd (already stored in sndRound)

Refactor GameController store method
 Store game/match, then hand off to the modecontrollers to store

Update migration for snd stuff
 We have lms and fb_wins
 foreach player, 1o


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

