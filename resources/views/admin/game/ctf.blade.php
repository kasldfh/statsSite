@extends('layouts.admin')
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
{!! Form::open(array('action'=>'CtfController@update', 'class'=>'form-inline', 'id' => 'form','method' => 'patch')) !!}
{{--<form class="form-inline">--}}
  <div class="form-group">
    <input type="hidden" name="game_id" value="{!!$game->id!!}">
    <input type="hidden" name="match_id" value="{!!$match->id!!}">
    <input type="hidden" name="mode_id" value="{!!$mode->id!!}">
    {{--This is where i can pass in extra values --}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row form-top">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 class="text">Update Capture the Flag Game</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5 class="text">{!!$match->rostera->team->name!!} vs. {!!$match->rosterb->team->name!!} at {!!$match->event->name!!}</h5>
                </div>
            </div>
            <div class="row" style="margin-bottom:10px">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                    {{--!!Form::label('map', 'Map')!!--}}
                    <label for="map">Map</label>
                    <select class="form-control" id="map" name="map">
                        @foreach($maps as $mapoption)
                           @if($game->map->name == $mapoption->name) 
                                <option value="{!!$mapoption->id!!}" selected="selected"> {!! $mapoption->name!!}</option>
                           @else
                                <option value="{!!$mapoption->id!!}">{!!$mapoption->name!!}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <div class="form-group">
                    <label for="minutes">Minutes</label>
                    <input type="text" name="minutes" class="form-control" size="5" value="{!!(int)($mode->game_time / 60)!!}">
                    <label for="seconds">Seconds</label>
                    <input type="text" name="seconds" class="form-control" size="5" value="{!!$mode->game_time % 60!!}">
                    {{--{!!Form::label('game_time', 'Game Time (IN SECONDS (MINUTES*60 + SECONDS))')!!}--}}
                    {{--{!! Form::text('game_time', '' , array('class'=>'form-control')) !!}--}}
                    </div>
                </div>
            </div>
            {{-- fix this (online add back online stuff) later --}}
{{--yield('host'--}}
@include('admin.game.host')
@yield('host')
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {{--{!! Form::text('a_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}--}}
                        <input type="text" name="a_score" class="form-control" value={!!$mode->team_a_score!!}>
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
                                    <th>Returns</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    {{--<td>{!!Form::select('player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>--}}
                                    <td>
                                    <select name="aplayers[]" class="form-control">
                                        <option value="{!!$ascores[$i-1]->player_id!!}" selected>{!! $ascores[$i-1]->alias !!}</option>
                                        @foreach($aplayers as $aplayer)
                                            @if($ascores[$i-1]->alias != $aplayer->player->alias)
                                                <option value="{!!$aplayer->player_id!!}">{!!$aplayer->player->alias!!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="kills[]" value="{!!$ascores[$i-1]->kills!!}">
                                   </td>
                                   <td>
                                        <input type="text" class="form-control" name="deaths[]" value="{!!$ascores[$i-1]->deaths!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="captures[]" value="{!!$ascores[$i-1]->captures!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="defends[]" value="{!!$ascores[$i-1]->defends!!}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="returns[]" value="{!!$ascores[$i-1]->returns!!}">
                                    </td>

                                    {{-- <td>{!! Form::text('kills[]', '' , array('class'=>'form-control')) !!}</td> --}}
                                    {{--<td>{!! Form::text('deaths[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                    {{--<td>{!! Form::text('captures[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                    {{--<td>{!! Form::text('defends[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {{--{!! Form::text('b_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}--}}
                        <input type="text" name="b_score" class="form-control" value={!!$mode->team_b_score!!}>
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
                                    <th>Returns</th>
                                </tr>
                            </thead>
                            <tbody>

                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    {{--<td>{!!Form::select('player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>--}}
                                    <td>
                                    <select name="bplayers[]" class="form-control">
                                        <option value="{!!$bscores[$i-1]->player_id!!}" selected>{!! $bscores[$i-1]->alias !!}</option>
                                        @foreach($bplayers as $bplayer)
                                            @if($bscores[$i-1]->alias != $bplayer->player->alias)
                                                <option value="{!!$bplayer->player_id!!}">{!!$bplayer->player->alias!!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    </td>
                                    <td>
                                      <input type="text" class="form-control" name="kills[]" value="{!!$bscores[$i-1]->kills!!}">
                                   </td>
                                   <td>
                                        <input type="text" class="form-control" name="deaths[]" value="{!!$bscores[$i-1]->deaths!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="captures[]" value="{!!$bscores[$i-1]->captures!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="defends[]" value="{!!$bscores[$i-1]->defends!!}">
                                    <td>
                                        <input type="text" class="form-control" name="returns[]" value="{!!$bscores[$i-1]->returns!!}">
                                    </td>
                                    </td>
                                {{--@for($i = 1; $i<=4; $i++)

                                <tr>
                                    <td>{!!Form::select('player[]', ['' => 'Select'] + $match->rosterb->players, [], ['class' => 'form-control'])!!}</td>
                                    <td>{!! Form::text('kills[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('deaths[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('captures[]', '' , array('class'=>'form-control')) !!}</td>
                                    <td>{!! Form::text('defends[]', '' , array('class'=>'form-control')) !!}</td>--}}
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                @include('admin.game.buttons')
                @yield('buttons')
        </div>
    </div>
    {!!Form::close()!!}
@endsection

@section('addback')
@endsection

