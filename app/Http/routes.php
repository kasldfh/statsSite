<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//iSeed routes (just going to call one controller)
Route::get('iseed', 'SeedController@seed');
//now matt's routes start


Route::resource('teams', 'TeamController');

//player fantasy rankings
Route::get('fantasy', ['uses' => 'PlayerScoreController@playerScores']);

//article routes
Route::post('article', 'ArticleController@store');
Route::get('article/manage', 'ArticleController@manage');
Route::get('articles', 'ArticleController@index');
Route::get('article/create', 'ArticleController@create');
Route::get('article/{id}', 'ArticleController@show');
Route::get('article/{id}/edit', 'ArticleController@edit');
Route::patch('article/{id}/update', 'ArticleController@update');
Route::get('article/delete/{id}', 'ArticleController@delete');

//Route::resource('articles', 'ArticleController');

//start old user stuff
Route::get('users/login', ['uses' => 'UsersController@login']);
Route::get('users/logout', ['uses' => 'UsersController@logout']);
Route::post('users/attempt', ['uses' => 'UsersController@attempt']);
Route::get('users/create/{token}', ['uses' => 'UsersController@create']);
Route::post('users/store', ['uses' => 'UsersController@store']);
Route::controller('password', 'RemindersController');

Route::get('admin/user/delete/{id}', ['uses' => 'SuperController@delete']);
Route::get('admin/userv/delete_confirm/{id}', ['uses' => 'SuperController@deleteConfirm']);

Route::get('admin/user/create', ['uses' => 'SuperController@create']);
Route::post('admin/user/store', ['uses' => 'SuperController@store']);
Route::get('admin/user/manage', ['uses' => 'SuperController@manage']);
//end old user stuff



Route::get('admin/dashboard', ['uses' => 'AdminController@dashboard']);
Route::get('admin/create', ['uses' => 'AdminController@create']);

Route::get('admin/test', ['uses' => 'AdminController@test']);

Route::get('admin/event/create', ['uses' => 'EventController@create']);
Route::post('admin/event/store', ['uses' => 'EventController@store']);
Route::get('admin/event/manage', ['uses' => 'EventController@manage']);
Route::get('admin/event/delete/{id}', ['uses' => 'EventController@delete']);

Route::get('admin/title/create', ['uses' => 'GameTitleController@create']);
Route::post('admin/title/store', ['uses' => 'GameTitleController@store']);
Route::get('admin/title/manage', ['uses' => 'GameTitleController@manage']);
Route::get('admin/title/delete/{id}', ['uses' => 'GameTitleController@delete']);

Route::get('admin/event_type/create', ['uses' => 'EventTypeController@create']);
Route::post('admin/event_type/store', ['uses' => 'EventTypeController@store']);
Route::get('admin/event_type/manage', ['uses' => 'EventTypeController@manage']);
Route::get('admin/event_type/delete/{id}', ['uses' => 'EventTypeController@delete']);

//TODO: finish roster event stuff
Route::get('admin/roster_event/create/{id}', ['uses' => 'RosterEventController@create']);
Route::get('admin/roster_event/manage/{id}', ['uses' => 'RosterEventController@manage']);
Route::get('admin/roster_event/store', ['uses' => 'RosterEventController@store']);
Route::get('admin/roster_event/delete/', ['uses' => 'RosterEventController@delete']);
Route::get('admin/edit_standings/{id}', ['uses' => 'RosterEventController@edit_standings']);
Route::post('admin/update_standings', ['uses' => 'RosterEventController@update_standings']);

Route::get('admin/map/delete/{id}', ['uses' => 'MapController@delete']);
Route::post('admin/map/store', ['uses' => 'MapController@store']);
Route::get('admin/map/create', ['uses' => 'MapController@create']);
Route::get('admin/map/manage', ['uses' => 'MapController@manage']);

Route::get('admin/mode/delete/{id}', ['uses' => 'ModeController@delete']);
Route::post('admin/mode/store', ['uses' => 'ModeController@store']);
Route::get('admin/mode/create', ['uses' => 'ModeController@create']);
Route::get('admin/mode/manage', ['uses' => 'ModeController@manage']);

Route::get('admin/item/delete/{id}', ['uses' => 'ItemController@delete']);
Route::post('admin/item/store', ['uses' => 'ItemController@store']);
Route::get('admin/item/create', ['uses' => 'ItemController@create']);
Route::get('admin/item/manage', ['uses' => 'ItemController@manage']);

Route::get('admin/map_mode/delete/{id}', ['uses' => 'MapModeController@delete']);
Route::post('admin/map_mode/store', ['uses' => 'MapModeController@store']);
Route::get('admin/map_mode/create', ['uses' => 'MapModeController@create']);
Route::get('admin/map_mode/manage', ['uses' => 'MapModeController@manage']);

Route::get('admin/match/delete/{id}', ['uses' => 'MatchController@delete']);
Route::post('admin/match/store', ['uses' => 'MatchController@store']);
Route::get('admin/match/create', ['uses' => 'MatchController@create']);
Route::get('admin/match/manage', ['uses' => 'MatchController@manage']);
Route::get('admin/match/forfeit/{id}', ['uses' => 'MatchController@forfeit']);
Route::post('admin/match/forfeit/{id}', ['uses' => 'MatchController@store_forfeit']);

Route::get('admin/match_type/delete/{id}', ['uses' => 'MatchTypeController@delete']);
Route::post('admin/match_type/store', ['uses' => 'MatchTypeController@store']);
Route::get('admin/match_type/create', ['uses' => 'MatchTypeController@create']);
Route::get('admin/match_type/manage', ['uses' => 'MatchTypeController@manage']);

Route::get('admin/team/delete/{id}', ['uses' => 'TeamController@delete']);
Route::post('admin/team/store', ['uses' => 'TeamController@store']);
Route::get('admin/team/create', ['uses' => 'TeamController@create']);
Route::get('admin/team/manage', ['uses' => 'TeamController@manage']);

Route::get('admin/player/delete/{id}', ['uses' => 'PlayerController@delete']);
Route::post('admin/player/store', ['uses' => 'PlayerController@store']);
Route::get('admin/player/create', ['uses' => 'PlayerController@create']);
Route::get('admin/player/manage', ['uses' => 'PlayerController@manage']);

Route::get('admin/roster/delete/{id}', ['uses' => 'RosterController@delete']);
Route::post('admin/roster/store', ['uses' => 'RosterController@store']);
Route::get('admin/roster/create', ['uses' => 'RosterController@create']);
Route::get('admin/roster/manage', ['uses' => 'RosterController@manage']);
Route::get('admin/roster/fix', ['uses' => 'RosterController@fix']);
Route::post('admin/roster/fix_process', ['uses' => 'RosterController@fixProcess']);

Route::get('admin/game/delete/{id}', ['uses' => 'GameController@delete']);
Route::post('admin/game/store', ['uses' => 'GameController@store']);
Route::get('admin/game/create/{id}', ['uses' => 'GameController@create']);
//added by le fail
//TODO: manage for game should maybe go into event controller as @manageGames...?
Route::get('admin/game/manage/{id}', ['uses' => 'GameController@manage']);
Route::get('admin/game/edit/{id}', ['uses' => 'GameController@edit']);
//Route::get('admin/game/{id}/edit', ['uses' => 'HpController@edit']);
Route::get('admin/hp/{id}/edit', ['uses' => 'HpController@edit']);
Route::get('admin/uplink/{id}/edit', ['uses' => 'UplinkController@edit']);
Route::get('admin/ctf/{id}/edit', ['uses' => 'CtfController@edit']);
Route::get('admin/snd/{id}/edit', ['uses' => 'SndController@edit']);
Route::patch('admin/hp/{id}/update', ['uses' => 'HpController@update']);
Route::patch('admin/uplink/{id}/update', ['uses' => 'UplinkController@update']);
Route::patch('admin/ctf/{id}/update', ['uses' => 'CtfController@update']);
Route::patch('admin/snd/{id}/update', ['uses' => 'SndController@update']);
Route::put('admin/snd/{id}/create',  ['uses' => 'SndController@create']);
Route::put('admin/snd/create',  ['uses' => 'SndController@create']);

//cache routes
Route::get('admin/cache/refresh', ['uses' => 'cachecontroller@index']);

Route::get('{name}', ['uses' => 'FrontEndTeamController@show']);
Route::get('event/{event_id}', ['uses' => 'FrontEndEventController@viewEvent']);
Route::get('player/{id}', ['uses' => 'FrontEndPlayerController@view']);
Route::get('player/{id}/detailed', ['uses' => 'FrontEndPlayerController@viewDetailed']);
Route::get('leaderboards/overall', ['uses' => 'LeaderboardController@view']);
Route::get('leaderboards/ctf', ['uses' => 'LeaderboardController@viewCTF']);
Route::get('leaderboards/uplink', ['uses' => 'LeaderboardController@viewUplink']);
Route::get('leaderboards/snd', ['uses' => 'LeaderboardController@viewSnD']);
Route::get('leaderboards/{event_id}', ['uses' => 'LeaderboardController@view']);
//todo: remove line below
Route::get('leaderboards/{id}', ['uses' => 'LeaderboardController@viewByEvent']);

