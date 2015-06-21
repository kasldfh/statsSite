@extends('layouts.main')

@section('style')
	
@endsection

@section('js')

@endsection
@section('content')
	{{ Form::open(array('action'=>'EventController@store', 'class'=>'form-login', 'id' => 'form')) }}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Create Event</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('event_name', 'Event Name')}}
					{{ Form::text('event_name', '' , array('class'=>'form-control', 'placeholder'=>'Event Name', 'data-fv-notempty' => 'true')) }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('event_type', 'Event Type')}}
    				{{ Form::select('event_type', ['' => 'Please Select An Event Type'] + $event_types->lists('name', 'id'), [], array('class'=>'form-control', 'placeholder'=>'Event Name', 'data-fv-notempty' => 'true')) }}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('game_title', 'Game Title')}}
    				{{ Form::select('game_title', ['' => 'Please Select A Game Title'] + $game_titles->lists('title', 'id'), [], array('class'=>'form-control', 'placeholder'=>'Event Name', 'data-fv-notempty' => 'true')) }}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
    				{{ Form::submit('Create', array('class'=>'btn btn-large btn-primary pull-right'))}}
    				{{ HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) }}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    {{Form::close()}}
@endsection