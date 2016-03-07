@extends('layouts.frontend')
@section('title')
  Leaderboards
@stop

@section('scripts')
  <style type="text/css">
  table.sortable tbody {
      counter-reset: sortabletablescope;
  }
  table.sortable thead tr:before {
      content: "";
      display: table-cell;
  }
  table.sortable tbody tr:before {
    font-size:13px;
      content: counter(sortabletablescope);
      counter-increment: sortabletablescope;
      display: table-cell;
  }
  </style>
@stop

@section('banner')
  <h1>{!!$event->name!!} LEADERBOARD</h1>
@stop

<!-- LEADERBOARD
================================================== -->
@section('content')
<section class="section gray stats event">
  <div class="wrap">

    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <table id="kdr" class="data sortable">
              <thead>
                <tr>
                  <td class="title">Player</td>
                  <td>K/D</td>
                  <td>HP Kills / Map</td>
                  <td>SND K/D</td>
                  <td>UL Dunks</td>
                  <td>HP Time</td>
                </tr>
              </thead>
              <tbody>
                @foreach($players as $player)
                  <tr>
                    <td class="title"><a href=""><img src={!!"/images/teams/".$player->team_logo!!} alt="" class="table-icon" />{!!$player->alias!!}</a></td>
                    <td>{!!$player->kd!!}</td>
                    <td>{!!$player->hpkpm!!}</td>
                    <td>{!!$player->sndkd!!}</td>
                    <td>{!!$player->uplink_dunks!!}</td>
                    <td>{!!$player->hp_time!!}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
      
  </div>

</section><!-- /leaderboard -->
@stop

@section('loadlast')
<script src="/frontend_assets/js/sortable.js"></script>
@stop
