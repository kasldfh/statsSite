@extends('layouts.main')

@section('style')
	
@endsection

@section('js')

@endsection
@section('content')
	{!! Form::open(array('action'=>'RosterController@fixProcess', 'class'=>'form-login', 'id' => 'form', 'files' => true)) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Please set player roles</h4>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
						<h4 class="text">Team: {!!$team->name!!} - Please Select Roles</h4>
    				</div>
    			</div>
			@foreach($players as $player)
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('role[]', $player->alias)!!}
    				{!! Form::select('role['. $player->id.']', ['' => 'Select Role', 'player' => 'Player', 'sub' => 'Sub'], [], array('class'=>'form-control', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>
			@endforeach
			{!!Form::hidden('team', $team->id)!!}
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