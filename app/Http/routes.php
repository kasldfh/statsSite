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

//home route
Route::get('/', 'IndexController@index');


//Event Routes
Route::get('event/{event_id}', ['uses' => 'FrontEndEventController@viewEvent']);
Route::get('event/GameTypeStats/{event_id}', 
    ['uses' => 'FrontEndEventController@viewGameTypeStatsByEvent']);
Route::get('event/leaderboard/{event_id}', 
    ['uses' => 'FrontEndEventController@viewLeaderboardsByEvent']);
Route::get('event/pickban/{event_id}', 
    ['uses' => 'FrontEndEventController@viewPickBanStatsByEvent']);
Route::get('event/specialist/{event_id}', 
    ['uses' => 'FrontEndEventController@viewSpecialistsByEvent']);
Route::get('event/stdev/{event_id}', 
    ['uses' => 'FrontEndEventController@viewStdevByEvent']);
Route::get('event/records/{event_id}', 
    ['uses' => 'FrontEndEventController@viewRecordsByEvent']);
//leaderboard for event
Route::get('leaderboards/{event_id}', ['uses' => 'LeaderboardController@view']);

//Player routes
Route::get('player/{alias}', ['uses' => 'FrontEndPlayerController@view']);
Route::get('player/{alias}/detailed', ['uses' => 'FrontEndPlayerController@viewDetailed']);

//about route
Route::get('about', 'AboutController@index');

//Team routes
Route::get('teams', 'FrontEndTeamController@index');
Route::get('{name}', ['uses' => 'FrontEndTeamController@show']);

//admin routes
Route::group(['middleware' => 'auth'], function() {

    Route::get('admin/excel', 'TestController@statUploader');

    //general admin routes
    Route::get('admin/dashboard', ['uses' => 'AdminController@dashboard']);
    Route::get('admin/cache/refresh', ['uses' => 'cachecontroller@index']);
    //TODO: get rid of all thie iseed stuff
    Route::get('iseed', 'SeedController@seed');

    //user routes
    Route::get('admin/user/delete/{id}', ['uses' => 'SuperController@delete']);
    Route::get('admin/user/create', ['uses' => 'SuperController@create']);
    Route::post('admin/user/store', ['uses' => 'SuperController@store']);
    Route::get('admin/user/manage', ['uses' => 'SuperController@manage']);

    //Event routes
    Route::get('admin/event/create', ['uses' => 'EventController@create']);
    Route::post('admin/event/store', ['uses' => 'EventController@store']);
    Route::get('admin/event/manage', ['uses' => 'EventController@manage']);
    Route::get('admin/event/delete/{id}', ['uses' => 'EventController@delete']);

    //Game title routes
    Route::get('admin/title/create', ['uses' => 'GameTitleController@create']);
    Route::post('admin/title/store', ['uses' => 'GameTitleController@store']);
    Route::get('admin/title/manage', ['uses' => 'GameTitleController@manage']);
    Route::get('admin/title/delete/{id}', ['uses' => 'GameTitleController@delete']);

    //Event type routes
    Route::get('admin/event_type/create', ['uses' => 'EventTypeController@create']);
    Route::post('admin/event_type/store', ['uses' => 'EventTypeController@store']);
    Route::get('admin/event_type/manage', ['uses' => 'EventTypeController@manage']);
    Route::get('admin/event_type/delete/{id}', ['uses' => 'EventTypeController@delete']);

    //RosterEvent routes
    Route::get('admin/roster_event/create/{id}', ['uses' => 'RosterEventController@create']);
    Route::get('admin/roster_event/manage/{id}', ['uses' => 'RosterEventController@manage']);
    Route::get('admin/roster_event/store', ['uses' => 'RosterEventController@store']);
    Route::get('admin/roster_event/delete/', ['uses' => 'RosterEventController@delete']);

    //standings routes
    Route::get('admin/edit_standings/{id}', ['uses' => 'RosterEventController@edit_standings']);
    Route::post('admin/update_standings', ['uses' => 'RosterEventController@update_standings']);

    //map routes
    Route::get('admin/map/delete/{id}', ['uses' => 'MapController@delete']);
    Route::post('admin/map/store', ['uses' => 'MapController@store']);
    Route::get('admin/map/create', ['uses' => 'MapController@create']);
    Route::get('admin/map/manage', ['uses' => 'MapController@manage']);

    //mode routes
    Route::get('admin/mode/delete/{id}', ['uses' => 'ModeController@delete']);
    Route::post('admin/mode/store', ['uses' => 'ModeController@store']);
    Route::get('admin/mode/create', ['uses' => 'ModeController@create']);
    Route::get('admin/mode/manage', ['uses' => 'ModeController@manage']);

    //item routes
    Route::get('admin/item/delete/{id}', ['uses' => 'ItemController@delete']);
    Route::post('admin/item/store', ['uses' => 'ItemController@store']);
    Route::get('admin/item/create', ['uses' => 'ItemController@create']);
    Route::get('admin/item/manage', ['uses' => 'ItemController@manage']);

    //map_mode routes
    Route::get('admin/map_mode/delete/{id}', ['uses' => 'MapModeController@delete']);
    Route::post('admin/map_mode/store', ['uses' => 'MapModeController@store']);
    Route::get('admin/map_mode/create', ['uses' => 'MapModeController@create']);
    Route::get('admin/map_mode/manage', ['uses' => 'MapModeController@manage']);

    //match routes
    Route::get('admin/match/delete/{id}', ['uses' => 'MatchController@delete']);
    Route::post('admin/match/store', ['uses' => 'MatchController@store']);
    Route::get('admin/match/create', ['uses' => 'MatchController@create']);
    Route::get('admin/match/manage', ['uses' => 'MatchController@manage']);
    Route::get('admin/match/forfeit/{id}', ['uses' => 'MatchController@forfeit']);
    Route::post('admin/match/forfeit/{id}', ['uses' => 'MatchController@store_forfeit']);

    //match type routes
    Route::get('admin/match_type/delete/{id}', ['uses' => 'MatchTypeController@delete']);
    Route::post('admin/match_type/store', ['uses' => 'MatchTypeController@store']);
    Route::get('admin/match_type/create', ['uses' => 'MatchTypeController@create']);
    Route::get('admin/match_type/manage', ['uses' => 'MatchTypeController@manage']);

    //team routes
    Route::get('admin/team/delete/{id}', ['uses' => 'TeamController@delete']);
    Route::post('admin/team/store', ['uses' => 'TeamController@store']);
    Route::get('admin/team/create', ['uses' => 'TeamController@create']);
    Route::get('admin/team/manage', ['uses' => 'TeamController@manage']);

    //player routes
    Route::get('admin/player/delete/{id}', ['uses' => 'PlayerController@delete']);
    Route::post('admin/player/store', ['uses' => 'PlayerController@store']);
    Route::get('admin/player/create', ['uses' => 'PlayerController@create']);
    Route::get('admin/player/manage', ['uses' => 'PlayerController@manage']);

    //rooster routes :d
    Route::get('admin/roster/delete/{id}', ['uses' => 'RosterController@delete']);
    Route::post('admin/roster/store', ['uses' => 'RosterController@store']);
    Route::get('admin/roster/create', ['uses' => 'RosterController@create']);
    Route::get('admin/roster/manage', ['uses' => 'RosterController@manage']);
    Route::get('admin/roster/fix', ['uses' => 'RosterController@fix']);
    Route::post('admin/roster/fix_process', ['uses' => 'RosterController@fixProcess']);

    //game routes
    Route::get('admin/game/delete/{id}', ['uses' => 'GameController@delete']);
    Route::post('admin/game/store', ['uses' => 'GameController@store']);
    Route::get('admin/game/create/{id}', ['uses' => 'GameController@create']);
    Route::get('admin/game/manage/{id}', ['uses' => 'GameController@manage']);
    Route::get('admin/game/edit/{id}', ['uses' => 'GameController@edit']);
    //route to get mlg's exposed games
    Route::post('admin/game/mlg/mock', ['uses' => 'GameController@mock']);
    Route::get('admin/game/mlg/mock', ['uses' => 'GameController@mock']);

    Route::post('admin/game/mlg/{id}', ['uses' => 'GameController@getMlgGame']);
    Route::get('admin/game/mlg/{id}', ['uses' => 'GameController@getMlgGame']);


    //hp routes
    Route::get('admin/hp/{id}/edit', ['uses' => 'HpController@edit']);
    Route::patch('admin/hp/{id}/update', ['uses' => 'HpController@update']);

    //uplink routes
    Route::get('admin/uplink/{id}/edit', ['uses' => 'UplinkController@edit']);
    Route::patch('admin/uplink/{id}/update', ['uses' => 'UplinkController@update']);

    //ctf routes
    Route::get('admin/ctf/{id}/edit', ['uses' => 'CtfController@edit']);
    Route::patch('admin/ctf/{id}/update', ['uses' => 'CtfController@update']);

    //snd routes
    Route::get('admin/snd/{id}/edit', ['uses' => 'SndController@edit']);
    Route::patch('admin/snd/{id}/update', ['uses' => 'SndController@update']);

    //random routes that the public shouldn't see
    Route::get('fantasy', ['uses' => 'PlayerScoreController@playerScores']);
    //TODO: remove all the article stuff?
    //article routes
    Route::post('article', 'ArticleController@store');
    Route::get('article/manage', 'ArticleController@manage');
    Route::get('articles', 'ArticleController@index');
    Route::get('article/create', 'ArticleController@create');
    Route::get('article/{id}', 'ArticleController@show');
    Route::get('article/{id}/edit', 'ArticleController@edit');
    Route::patch('article/{id}/update', 'ArticleController@update');
    Route::get('article/delete/{id}', 'ArticleController@delete');

    //Route::resource('teams', 'TeamController');
    Route::get('leaderboards/overall', ['uses' => 'LeaderboardController@view']);
    Route::get('leaderboards/ctf', ['uses' => 'LeaderboardController@viewCTF']);
    Route::get('leaderboards/uplink', ['uses' => 'LeaderboardController@viewUplink']);
    Route::get('leaderboards/snd', ['uses' => 'LeaderboardController@viewSnD']);
    //**** end random routes
});

//user routes
Route::get('users/login', ['uses' => 'UsersController@login']);
Route::get('users/logout', ['uses' => 'UsersController@logout']);
Route::post('users/attempt', ['uses' => 'UsersController@attempt']);
Route::get('users/create/{token}', ['uses' => 'UsersController@create']);
Route::post('users/store', ['uses' => 'UsersController@store']);
Route::controller('password', 'RemindersController');

