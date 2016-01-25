@extends('layouts.admin')
@section('content')
<h1>Forfeit Match</h1>
<h5>Note: This will ignore all inputted maps for this match. For map forfeits, input the proper map with two negative scores, the higher of which is the winner's score. For example, if -2 and -5 are entered, the winner is -2. </h5>

{!! Form::open(['url' => 'admin/match/forfeit/'.$match->id, 'method' => 'post', 'class' => 'form-default']) !!}
{!! Form::label('team', 'Team that Forfeited')!!}
{!! Form::select('team', ['' => 'Select', $roster_a->id => $roster_a->team->name, $roster_b->id => $roster_b->team->name], '', ['class' => 'form-control'])!!}
{!! Form::submit('Submit', ['class' => 'btn btn-primary'])!!}
{!!Form::close()!!}
@stop
