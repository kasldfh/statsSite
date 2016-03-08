@extends('layouts.frontend')
@section('title')
    {!!$event->name!!}
@stop

{{--<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6">--}}
  
@section('banner')
    <img src="images/events/cod-world-league.png" alt="" />
  <a href="#" class="photo-credit">Photograph by @somebody123</a>  
@stop

@section('content')
<header class="details">
  <div class="wrap">
    <nav class="section-nav">
      <ul>
        <li class="active"><a href="{!!'/event/' . $event->id!!}">Standings</a></li>
        <li><a href="{!!'/event/leaderboard/' . $event->id!!}">Leaderboards</a></li>
        <li><a href="{!!'/event/GameTypeStats/' . $event->id!!}">Game Type</a></li>
        <li><a href="{!!'/event/records/' . $event->id!!}">Records</a></li>
        <li><a href="{!!'/event/specialist/' . $event->id!!}">Specialists</a></li>
        <li><a href="{!!'/event/pickban/' . $event->id!!}">Pick/Bans</a></li>
        <li><a href="{!!'/event/stdev/' . $event->id!!}">STDEV Stats</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- EVENT DETAILS
================================================== -->
<section class="section gray stats event">
  <div class="wrap">
    <h3>Top Performers</h3>
    <div class="row">
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src={!!"/images/players/" . $topkd->photo_url!!} alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">{!!$topkd->alias!!}</a></span>
          <span class="player-detail">Highest K/D<em>{!!$topkd->kd!!}</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src={!!"/images/players/" . $topslayer->photo_url!!} alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">{!!$topslayer->alias!!}</a></span>
          <span class="player-detail">Top Slayer<em>{!!$topslayer->slayer!!}</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src={!!"/images/players/" . $topul_dunks->photo_url!!} alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="#">{!!$topul_dunks->alias!!}</a></span>
          <span class="player-detail">Most UL Caps<em>{!!$topul_dunks->uplink_dunks!!}</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src={!!"/images/players/" . $tophp_time->photo_url!!} alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">{!!$tophp_time->alias!!}</a></span>
          <span class="player-detail">Time in HP<em>{!!$tophp_time->hp_time!!}</em></span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <table id="kdr" class="data">
              <thead>
                <tr>
                  <td>#</td>
                  <td class="title">Team Standings</td>
                  <td>Wins</td>
                  <td>Losses</td>
                  <td>Win %</td>
                  <td>Map Wins</td>
                  <td>Map Losses</td>
                  <td>K/D Ratio</td>
                </tr>
              </thead>
              <tbody>
                @foreach($rosters as $roster)
                <tr>
                  <td>{!!$roster->placing!!}</td>
                  <td class="title"><a href=""><img src={!!"/images/teams/" . $roster->roster->team->id!!} alt="" class="table-icon" />{!!$roster->roster->team->name!!}</a></td>
                  <td>{!!$roster->wins!!}</td>
                  <td>{!!$roster->losses!!}</td>
                  <td>{!!$roster->winpercent!!}%</td>
                  <td>{!!$roster->mapwins!!}</td>
                  <td>{!!$roster->maplosses!!}</td>
                  <td>420.69</td>
                </tr>
                @endforeach
              </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
      
  </div>

</section><!-- /event listings -->
@stop
