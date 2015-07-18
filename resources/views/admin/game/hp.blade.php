@extends('layouts.main')
@section('js')
{{-- determine if given player id is in the list of players (for determining selected attribute --}}
<?php
    function containsId($players, $id)
    {
        foreach($players as $player)
            if($player->player_id == $id)
                return true;
        return false;
    }
?>
@endsection
@section('content')
{!! Form::open(array('action'=>'HpController@update', 'class'=>'form-inline', 'id' => 'form','method' => 'patch')) !!}
{{--<form class="form-inline">--}}
  <div class="form-group">
    <input type="hidden" name="game_id" value="{!!$game->id!!}">
    {{--This is where i can pass in extra values --}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row form-top">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 class="text">Update Hardpoint Game</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5 class="text">{!!$match->rostera->team->name!!} vs. {!!$match->rosterb->team->name!!} at {!!$match->event->name!!}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {{--!!Form::label('map', 'Map')!!--}}
                    <label for="map">Map</label>
                    <select class="form-control" id = "map">
                        @foreach($maps as $mapoption)
                           @if($game->map->name == $mapoption->name) 
                                <option selected="selected"> {!! $mapoption->name!!}</option>
                           @else
                                <option>{!!$mapoption->name!!}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
            {{-- fix this (online add back online stuff) later --}}
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {{--{!! Form::text('a_hp_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}--}}
                        <input type="text" name="a_hp_score" class="form-control" value={!!$hp->team_a_score!!}>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Captures</th>
                                    <th>Defends</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    {{--<td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>--}}
                                    <td>
                                    <select class="form-control">
                                        <option selected>{!! $ascores[$i-1]->alias !!}</option>
                                        @foreach($aplayers as $aplayer)
                                            @if($ascores[$i-1]->alias != $aplayer->player->alias)
                                                <option>{!!$aplayer->player->alias!!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="hp_kills[]" value="{!!$ascores[$i-1]->kills!!}">
                                   </td>
                                   <td>
                                        <input type="text" class="form-control" name="hp_deaths[]" value="{!!$ascores[$i-1]->deaths!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="hp_captures[]" value="{!!$ascores[$i-1]->captures!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="hp_defends[]" value="{!!$ascores[$i-1]->defends!!}">
                                    </td>

                                    {{-- <td>{!! Form::text('hp_kills[]', '' , array('class'=>'form-control')) !!}</td> --}}
                                    {{--<td>{!! Form::text('hp_deaths[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                    {{--<td>{!! Form::text('hp_captures[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                    {{--<td>{!! Form::text('hp_defends[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {{--{!! Form::text('b_hp_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}--}}
                        <input type="text" name="b_hp_score" class="form-control" value={!!$hp->team_b_score!!}>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Captures</th>
                                    <th>Defends</th>
                                </tr>
                            </thead>
                            <tbody>

                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    {{--<td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>--}}
                                    <td>
                                    <select class="form-control">
                                        <option selected>{!! $bscores[$i-1]->alias !!}</option>
                                        @foreach($bplayers as $bplayer)
                                            @if($bscores[$i-1]->alias != $bplayer->player->alias)
                                                <option>{!!$bplayer->player->alias!!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="hp_kills[]" value="{!!$bscores[$i-1]->kills!!}">
                                   </td>
                                   <td>
                                        <input type="text" class="form-control" name="hp_deaths[]" value="{!!$bscores[$i-1]->deaths!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="hp_captures[]" value="{!!$bscores[$i-1]->captures!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="hp_defends[]" value="{!!$bscores[$i-1]->defends!!}">
                                    </td>
                                {{--@for($i = 1; $i<=4; $i++)

                                <tr>
                                    <td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('hp_kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_captures[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('hp_defends[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                    {!! Form::submit('Update Map', array('class'=>'btn btn-large btn-primary pull-right'))!!}
                    {!! HTML::link(URL::previous(), 'Cancel', array('class' => 'btn btn-default pull-right')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection

@section('addback')
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
    {!!Form::label('game_time', 'Game Time (IN SECONDS (MINUTES*60 + SECONDS))')!!}
    {!! Form::text('game_time', '' , array('class'=>'form-control')) !!}
    </div>
</div>
            @if($match->event->type->name == "Online")
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {!!Form::label('host', 'Team Host')!!}
                    {!! Form::select('host', ['' => 'Please Select A Team Host'] + $match->teamletter,[], ['id' => 'host', 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                    {!!Form::label('p_host', 'Player Host')!!}
                    {!!Form::select('p_host', ['' => 'Please Select A Player Host'] + $match->rostera->players + $match->rosterb->players, [], ['class' => 'form-control'])!!}
                    </div>
                </div>
            </div>
            @endif
@endsection
