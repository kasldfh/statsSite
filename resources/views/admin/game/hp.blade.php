@extends('layouts.admin')
@section('content')
{!! Form::open(array('action'=>'HpController@update', 'class'=>'form-inline', 'id' => 'form','method' => 'patch')) !!}
  <div class="form-group">
    <input type="hidden" name="game_id" value="{!!$game->id!!}">
    <input type="hidden" name="match_id" value="{!!$match->id!!}">
    <input type="hidden" name="mode_id" value="{!!$mode->id!!}">
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
@include('admin.game.general')
@yield('general')
@yield('host')
@yield('picks')
@yield('specialist')
      </div>
    </div>
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
            <th>Time</th>
            <th>Defends</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i <= 4; $i++)
          <tr>
            <td>{!! Form::select('aplayers[]', $aplayerarr, $ascores[$i-1]->player_id, ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('kills[]', $ascores[$i-1]->kills , ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('deaths[]', $ascores[$i-1]->deaths , ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('time[]', $ascores[$i-1]->time?strval(intval($ascores[$i-1]->time / 60)) . ':' . strval($ascores[$i-1]->time % 60) :'', ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('defends[]', $ascores[$i-1]->defends , ['class'=>'form-control']) !!}</td>
          </tr>
          @endfor
            {{--@for($i = count($ascores); $i < 4; $i++)--}}
            {{--<tr>--}}
                {{--<td>{!! Form::select('aplayers[]', ['' => 'Select'] + $aplayerarr, ['class'=>'form-control']) !!}</td>--}}
                {{--<td>{!! Form::text('kills[]', '', ['class'=>'form-control']) !!}</td>--}}
                {{--<td>{!! Form::text('deaths[]', '', ['class'=>'form-control']) !!}</td>--}}
                {{--<td>{!! Form::text('captures[]', '', ['class'=>'form-control']) !!}</td>--}}
                {{--<td>{!! Form::text('defends[]', '', ['class'=>'form-control']) !!}</td>--}}
            {{--</tr>--}}
            {{--@endfor--}}
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
            <th>Time</th>
            <th>Defends</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i <= 4; $i++)
          <tr>
            <td>{!! Form::select('bplayers[]', $bplayerarr, $bscores[$i-1]->player_id, ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('kills[]', $bscores[$i-1]->kills , ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('deaths[]', $bscores[$i-1]->deaths , ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('time[]', $bscores[$i-1]->time?strval(intval($bscores[$i-1]->time / 60)) . ':' . strval($bscores[$i-1]->time % 60) :'', ['class'=>'form-control']) !!}</td>
            <td>{!! Form::text('defends[]', $bscores[$i-1]->defends , ['class'=>'form-control']) !!}</td>
          </tr>
          @endfor
          {{--@for($i = count($bscores); $i < 4; $i++)--}}
          {{--<tr>--}}
              {{--<td>{!! Form::select('bplayers[]', ['' => 'Select'] + $bplayerarr, ['class'=>'form-control']) !!}</td>--}}
              {{--<td>{!! Form::text('kills[]', '', ['class'=>'form-control']) !!}</td>--}}
              {{--<td>{!! Form::text('deaths[]', '', ['class'=>'form-control']) !!}</td>--}}
              {{--<td>{!! Form::text('captures[]', '', ['class'=>'form-control']) !!}</td>--}}
              {{--<td>{!! Form::text('defends[]', '', ['class'=>'form-control']) !!}</td>--}}
          {{--</tr>--}}
          {{--@endfor--}}
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
