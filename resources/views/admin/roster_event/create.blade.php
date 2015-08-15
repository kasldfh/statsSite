@extends('layouts.main')

@section('content')
    {!! Form::open(['action'=>'RosterEventController@store', 'class'=>'form-login', 'id'=>'form') !!}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Add Roster to Event {!!$event->name!!}</h4>
				</div>
			</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('event_id', 'Event')!!}
    				{!! Form::select('event_id', ['' => 'Please Select An Event'] + $game_titles->lists('title', 'id')->all(), [], array('class'=>'form-control', 'placeholder'=>'Event Name', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
    				{!! Form::submit('Create', array('class'=>'btn btn-large btn-primary pull-right'))!!}
    				{!! HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) !!}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    {!!Form::close()!!}
@endsection
