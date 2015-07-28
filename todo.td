Refactor SndRound stuff
 Store player round stats (lms/fb/lmsW/fbW) in rounds only
  Remove these stats from SndPlayer(already stored in sndRound)
 Store team round stats (o/dW, plant/plantW)
  Remove these stats from Snd (already stored in sndRound)

Add team round stats to create@SndController

Refactor GameController store method
 Store game/match, then hand off to the modecontrollers to store

Add getters for team round stats in App\Snd. Find list in remove_round_stats 
migration. Added a rounds getter, perhaps do the team stats in sndcontroller?

Put snd migrations back into migrations folder(when fixed)

Refactor game_number to have its own text box in input, not rely on id hackery

Game shouldn't have score_type column, that's for match
