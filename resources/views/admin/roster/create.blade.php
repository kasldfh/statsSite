@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
<script>

  	$('#team_select').select2();
  	$('#player_select').select2();
	$('#team_select').on("select2:select", function (e) { 

		$('#form').formValidation('revalidateField', 'team');
	});

</script>
@endsection
@section('content')
	{{ Form::open(array('action'=>'RosterController@store', 'class'=>'form-login', 'id' => 'form', 'files' => true)) }}
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Create Roster</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('team', 'Team')}}
    				{{ Form::select('team', ['' => 'Please Select A Team'] + $teams->lists('name', 'id'), [], array('class'=>'form-control select2', 'data-fv-notempty' => 'true', 'id' => 'team_select')) }}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{{Form::label('players[]', 'Players')}}
    				{{ Form::select('players[]', $players->lists('alias', 'id'), [], array('class'=>'form-control select2', 'multiple' => 'multiple', 'data-fv-notempty' => 'true', 'id' => 'player_select')) }}
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