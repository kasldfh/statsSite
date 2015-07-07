@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
<script type="text/javascript">
$( document ).ready(function() {
        $(".to_hide").hide();
        $("body").on("change", "#score_type", function() {
            var value = parseInt($(this).val());
            if(value == 3) {
                $(".to_hide").hide();
                $("#score_div").show();
            } else {
                $(".to_hide").hide();
            }
        });
    });
</script>
@endsection
@section('content')
    @if(isset($match))
    {!! Form::model($match, ['route' => ['updateroute', $match->id], 'method' => 'patch']) !!}
    @else
	{!! Form::open(array('action'=>'MatchController@store', 'class'=>'form-login', 'id' => 'form')) !!}
    @endif
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			<div class="row form-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h4 class="text">Create Match</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('event', 'Event')!!}
    				{!! Form::select('event', ['' => 'Please Select An Event'] + $events->lists('name', 'id')->all(), [], array('class'=>'form-control', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('team_a', 'Team A')!!}
    				{!! Form::select('team_a', ['' => 'Please Select Team A'] + $teams->lists('name', 'id')->all(), [], array('class'=>'form-control', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('team_b', 'Team B')!!}
    				{!! Form::select('team_b', ['' => 'Please Select Team B'] + $teams->lists('name', 'id')->all(), [], array('class'=>'form-control', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>
    		<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="form-group">
					{!!Form::label('match_type', 'Match Type')!!}
    				{!! Form::select('match_type', ['' => 'Please Select An Match Type'] + $match_types->lists('name', 'id')->all(), [], array('class'=>'form-control', 'data-fv-notempty' => 'true')) !!}
    				</div>
    			</div>
    		</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                    {!!Form::label('score_type', 'Score Type')!!}
                    {!! Form::select('score_type', ['' => 'Please Select A Score Type'] + $score_types->lists('name', 'id')->all(), [], array('class'=>'form-control', 'data-fv-notempty' => 'true', 'id' => 'score_type')) !!}
                    </div>
                </div>
            </div>
            <div id="score_div" style="display:none;" class="to_hide">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                        {!!Form::label('team_a_score', 'Team A Map Count')!!}
                        {!! Form::text('team_a_score', '' , array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                        {!!Form::label('team_b_score', 'Team B Map Count')!!}
                        {!! Form::text('team_b_score', '' , array('class'=>'form-control')) !!}
                        </div>
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
