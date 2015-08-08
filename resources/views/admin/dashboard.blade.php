@extends('layouts.main')

@section('style')
	
@endsection

@section('js')

@endsection
@section('content')
	<h2 class="text">Administration</h2>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			  <div class="panel-heading">
			    <h4 class="panel-title text">Events</h4>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" >{!!link_to_action('EventController@create', 'Create Event', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('MatchController@create', 'Create Match', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('EventTypeController@create', 'Create Event Type', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('MatchTypeController@create', 'Create Match Type', [], [])!!}</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" class="presentation">{!!link_to_action('EventController@manage', 'Manage Events', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('MatchController@manage', 'Manage Matches', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('EventTypeController@manage', 'Manage Event Types', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('MatchTypeController@manage', 'Manage Match Types', [], [])!!}</li>
					</ul>
				</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			  <div class="panel-heading">
			    <h4 class="panel-title text">Teams</h4>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  
					  <li role="presentation" >{!!link_to_action('RosterController@create', 'Create Roster', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('PlayerController@create', 'Create Player', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('TeamController@create', 'Create Team', [], [])!!}</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" class="presentation">{!!link_to_action('RosterController@manage', 'Manage Rosters', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('PlayerController@manage', 'Manage Players', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('TeamController@manage', 'Manage Teams', [], [])!!}</li>
					</ul>
				</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			  <div class="panel-heading">
			    <h4 class="panel-title text">Games</h4>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" >{!!link_to_action('GameTitleController@create', 'Create Game Title', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('MapController@create', 'Create Map', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('ModeController@create', 'Create Mode', [], [])!!}</li>
					  <li role="presentation" >{!!link_to_action('MapModeController@create', 'Create Competitive Map/Mode', [], [])!!}</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" class="presentation">{!!link_to_action('GameTitleController@manage', 'Manage Game Titles', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('MapController@manage', 'Manage Maps', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('ModeController@manage', 'Manage Modes', [], [])!!}</li>
					  <li role="presentation" class="presentation">{!!link_to_action('MapModeController@manage', 'Manage Competitive Maps/Modes', [], [])!!}</li>
					</ul>
				</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	@if(Auth::user()->admin)
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			  <div class="panel-heading">
			    <h4 class="panel-title text">Web Admins</h4>
			  </div>
			  <div class="panel-body">
			  	<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" >{!!link_to_action('SuperController@create', 'Create Admin', [], [])!!}</li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<ul class="nav nav-pills nav-stacked">
					  <li role="presentation" class="presentation">{!!link_to_action('SuperController@manage', 'Manage Admins', [], [])!!}</li>
					</ul>
				</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	@endif
@endsection
