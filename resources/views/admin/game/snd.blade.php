@extends('layouts.admin')
@section('content')
{!! Form::open(array('action'=>'SndController@update', 'class'=>'form-inline', 'id' => 'form','method' => 'patch')) !!}
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
            <h4 class="text">Update Search and Destroy Game</h4>
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
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
          <h4 type="text">{!!$match->rostera->team->name!!}</h4>
        </div>
        <div class="row to_hide snd_div" style="">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>First Blood</th>
                  <th>Planter</th>
                  <th>Site</th>
                  <th>Victor</th>
                  <th>Side Won</th>
                </tr>
              </thead>
              <tbody>
                <?php $existingRounds = $mode->team_a_score + $mode->team_b_score;?>
                @for($i = 1; $i <= 11; $i++)
                  <tr>
                    <td><h5 class="text">Round {!!$i!!}</h5></td>
                    <td>{!!Form::select('fb[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, ($i <= $existingRounds ?  $rounds[$i-1]->fb_player_id: []),  ['class' => 'form-control'])!!}</td>
                    <td>{!!Form::select('planter[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, ($i <= $existingRounds ? ['' => $rounds[$i-1]->planter_id] : []), ['class' => 'form-control'])!!}</td>
                    <td>{!!Form::select('site[]', ['' => 'Select', 'a' => 'A', 'b' => 'B'], ($i <= $existingRounds ? ['' => $rounds[$i-1]->plant_site] : []), ['class' => 'form-control'])!!}</td>
                    <td>{!!Form::select('victor[]', ['' => 'Select'] +  $match->teams, ($i <= $existingRounds ? ['' => $rounds[$i-1]->victor_id] : []), ['class' => 'form-control'])!!}</td>
                    <td>{!!Form::select('side[]', ['' => 'Select', 'o' => 'Offense', 'd' => 'Defense'], ($i <= $existingRounds ? ['' => $rounds[$i-1]->side_won] : []), ['class' => 'form-control'])!!}</td>
                  </tr>
                @endfor
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
          <h4 type="text">{!!$match->rostera->team->name!!}</h4>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <input type="text" name="a_score" class="form-control" value={!!$mode->team_a_score!!}>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Player</th>
                <th>Kills</th>
                <th>Deaths</th>
                <th>Plants</th>
                <th>Defuses</th>
              </tr>
            </thead>
            <tbody>
              @for($i = 1; $i <= 4; $i++)
                <tr>
                  <td>{!! Form::select('aplayers[]', $aplayerarr, $ascores[$i-1]->player_id, ['class'=>'form-control']) !!}</td>
                  <td>{!! Form::text('kills[]', $ascores[$i-1]->kills , ['class'=>'form-control']) !!}</td>
                  <td>{!! Form::text('deaths[]', $ascores[$i-1]->deaths , ['class'=>'form-control']) !!}</td>
                  <td>{!! Form::text('plants[]', $ascores[$i-1]->plants , ['class'=>'form-control']) !!}</td>
                  <td>{!! Form::text('defuses[]', $ascores[$i-1]->defuses , ['class'=>'form-control']) !!}</td>
                @endfor
              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h4 type="text">{!!$match->rosterb->team->name!!}</h4>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <input type="text" name="b_score" class="form-control" value={!!$mode->team_b_score!!}>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Player</th>
                  <th>Kills</th>
                  <th>Deaths</th>
                  <th>Plants</th>
                  <th>Defuses</th>
                </tr>
              </thead>
              <tbody>
                 @for($i = 1; $i <= 4; $i++)
                   <tr>
                     <td>{!! Form::select('bplayers[]', $bplayerarr, $bscores[$i-1]->player_id, ['class'=>'form-control']) !!}</td>
                     <td>{!! Form::text('kills[]', $bscores[$i-1]->kills , ['class'=>'form-control']) !!}</td>
                     <td>{!! Form::text('deaths[]', $bscores[$i-1]->deaths , ['class'=>'form-control']) !!}</td>
                     <td>{!! Form::text('plants[]', $bscores[$i-1]->plants , ['class'=>'form-control']) !!}</td>
                     <td>{!! Form::text('defuses[]', $bscores[$i-1]->defuses , ['class'=>'form-control']) !!}</td>
                   </tr>
                 @endfor
               </tbody>
             </table>
           </div>
@include('admin.game.buttons')
@yield('buttons')
      </div>
    </div>
  </div>
{!!Form::close()!!}
@endsection
