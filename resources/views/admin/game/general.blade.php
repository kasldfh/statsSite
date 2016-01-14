@section('general')
    <div class="row" style="margin-bottom:10px">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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
                <label for="game_number">Game Number</label>
                <input type="text" name="game_number" value={!!$game->game_number!!} class="form-control">                        
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
@endsection

@section('host')
    @if($match->event->type->name == "Online")
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
            <label for="host">Team Host</label>
            {{--{!!Form::label('host', 'Team Host')!!}--}}
            {!! Form::select('host', ['' => 'Please Select A Team Host'] + $match->teams,[$mode->team_host_id], ['id' => 'host', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
            {!!Form::label('p_host', 'Player Host')!!}
            {!!Form::select('p_host', ['' => 'Please Select A Player Host'] + $match->rostera->players + $match->rosterb->players, [$mode->pHost], ['class' => 'form-control'])!!}
            </div>
        </div>
    </div>
    @endif
@endsection

@section('picks')
<div class="row" style="">
  <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
    <h4 type="text">Picks and Bans</h4>
  </div>

  <div class="" style="">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Player</th>
            <th>Pick or Ban</th>
            <th>Item</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i<=8; $i++)
          <tr>
          <?php 
          $player = '';
          $item = '';
          $type = '';
          foreach($picks as $pick) {
            if($pick->number == $i) {
              $player = $pick->player_id;
              $item = $pick->item_id;
              $type = $pick->pick_type;
            }
          }
          ?>

          <td>{!!Form::select('pickers[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, $player, ['class' => 'form-control'])!!}</td>
              {{--we expect this numbering in the gamecontroller store method--}}
              <td>{!! Form::select('pick_types[]', ['0' => 'Select', '1' => 'Protect', '2' => 'Ban', '3' => 'Missed', '4' => 'No Choice'], $type, ['class'=>'form-control']) !!}</td>
              <td>{!! Form::select('pick_items[]', [''=>'Select'] + $items->toArray(), $item,  ['class'=>'form-control']) !!}</td>
          </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('specialist')
<div class="row" style="">
  <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
    <h4 type="text">Specialist Selections</h4>
  </div>

  <div class="" style="">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Player</th>
            <th>Specialist</th>
          </tr>
        </thead>
        <tbody>
          @for($i = 1; $i<=8; $i++)
          <tr>
<?php $specialist_player_id = $i <= 4 ? $match->rostera->starters[$i-1]->player_id : $match->rosterb->starters[$i-5]->player_id?>
            <td>{!!Form::select('specialist_players[]', ['' => 'Select'] + $match->rostera->players + $match->rosterb->players, $specialist_player_id, ['class' => 'form-control'])!!}</td>
              <td>{!!Form::select('specialists[]', ['' => 'Select'] + $specialists->toArray(), $specialist_players->has($specialist_player_id) ? $specialist_players[$specialist_player_id] : [], ['class' => 'form-control'])!!}</td>
          </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop
