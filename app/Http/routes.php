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

Route::get('users/login', ['uses' => 'UsersController@login']);
Route::get('users/logout', ['uses' => 'UsersController@logout']);
Route::post('users/attempt', ['uses' => 'UsersController@attempt']);
Route::get('users/create/{token}', ['uses' => 'UsersController@create']);
Route::post('users/store', ['uses' => 'UsersController@store']);

Route::get('admin/dashboard', ['uses' => 'AdminController@dashboard']);
Route::get('admin/create', ['uses' => 'AdminController@create']);

Route::get('admin/user/delete/{id}', ['uses' => 'SuperController@delete']);
Route::get('admin/userv/delete_confirm/{id}', ['uses' => 'SuperController@deleteConfirm']);

Route::get('admin/user/create', ['uses' => 'SuperController@create']);
Route::post('admin/user/store', ['uses' => 'SuperController@store']);
Route::get('admin/user/manage', ['uses' => 'SuperController@manage']);

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

Route::get('admin/map/delete/{id}', ['uses' => 'MapController@delete']);
Route::post('admin/map/store', ['uses' => 'MapController@store']);
Route::get('admin/map/create', ['uses' => 'MapController@create']);
Route::get('admin/map/manage', ['uses' => 'MapController@manage']);

Route::get('admin/mode/delete/{id}', ['uses' => 'ModeController@delete']);
Route::post('admin/mode/store', ['uses' => 'ModeController@store']);
Route::get('admin/mode/create', ['uses' => 'ModeController@create']);
Route::get('admin/mode/manage', ['uses' => 'ModeController@manage']);

Route::get('admin/map_mode/delete/{id}', ['uses' => 'MapModeController@delete']);
Route::post('admin/map_mode/store', ['uses' => 'MapModeController@store']);
Route::get('admin/map_mode/create', ['uses' => 'MapModeController@create']);
Route::get('admin/map_mode/manage', ['uses' => 'MapModeController@manage']);

Route::get('admin/match/delete/{id}', ['uses' => 'MatchController@delete']);
Route::post('admin/match/store', ['uses' => 'MatchController@store']);
Route::get('admin/match/create', ['uses' => 'MatchController@create']);
Route::get('admin/match/manage', ['uses' => 'MatchController@manage']);

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
Route::get('admin/game/{id}/edit', ['uses' => 'HpController@edit']);
Route::get('admin/game/manage', ['uses' => 'GameController@manage']);

Route::get('{team}', ['uses' => 'FrontEndTeamController@show']);
Route::get('event/{event_id}', ['uses' => 'FrontEndEventController@viewEvent']);
Route::get('player/{id}', ['uses' => 'FrontEndPlayerController@view']);
Route::get('player/{id}/detailed', ['uses' => 'FrontEndPlayerController@viewDetailed']);
Route::get('leaderboards/overall', ['uses' => 'LeaderboardController@view']);
Route::get('leaderboards/ctf', ['uses' => 'LeaderboardController@viewCTF']);
Route::get('leaderboards/uplink', ['uses' => 'LeaderboardController@viewUplink']);
Route::get('leaderboards/snd', ['uses' => 'LeaderboardController@viewSnD']);
Route::get('leaderboards/{id}', ['uses' => 'LeaderboardController@viewByEvent']);

Route::controller('password', 'RemindersController');
