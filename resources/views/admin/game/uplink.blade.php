

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
{!! Form::open(array('action'=>'UplinkController@update', 'class'=>'form-inline', 'id' => 'form','method' => 'patch')) !!}
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
                    <h4 class="text">Update Uplink Game</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5 class="text">{!!$match->rostera->team->name!!} vs. {!!$match->rosterb->team->name!!} at {!!$match->event->name!!}</h5>
                </div>
            </div>
@include('admin.game.general')
@yield('general')
@yield('host')
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <h4 type="text">{!!$match->rostera->team->name!!}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        {{--{!! Form::text('a_hp_score', '' , array('class'=>'form-control', 'placeholder'=>'Score')) !!}--}}
                        <input type="text" name="a_hp_score" class="form-control" value={!!$mode->team_a_score!!}>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Uplinks</th>
                                    <th>Interceptions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    {{--<td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>--}}
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
                                        <input type="text" class="form-control" name="uplinks[]" value="{!!$ascores[$i-1]->uplinks!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="interceptions[]" value="{!!$ascores[$i-1]->interceptions!!}">
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
                        <input type="text" name="b_hp_score" class="form-control" value={!!$mode->team_b_score!!}>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Kills</th>
                                    <th>Deaths</th>
                                    <th>Uplinks</th>
                                    <th>Interceptions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @for($i = 1; $i<=4; $i++)
                                <tr>
                                    {{--<td>{!!Form::select('hp_player[]', ['' => 'Select'] + $match->rostera->players, [], ['class' => 'form-control'])!!}</td>--}}
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
                                        <input type="text" class="form-control" name="uplinks[]" value="{!!$bscores[$i-1]->uplinks!!}">
                                    </td>
                                   <td>
                                        <input type="text" class="form-control" name="interceptions[]" value="{!!$bscores[$i-1]->interceptions!!}">
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
                @include('admin.game.buttons')
                @yield('buttons')
        </div>
    </div>
    {!!Form::close()!!}
@endsection

@section('addback')
@endsection
