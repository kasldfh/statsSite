@extends('layouts.frontend')
@section('title')
  Records | {!!$event->name!!}
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
        <li><a href="{!!'/event/' . $event->id!!}">Standings</a></li>
        <li><a href="{!!'/event/leaderboard/' . $event->id!!}">Leaderboards</a></li>
        <li><a href="{!!'/event/GameTypeStats/' . $event->id!!}">Game Type</a></li>
        <li class="active"><a href="{!!'/event/records/' . $event->id!!}">Records</a></li>
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

    <h3>Most Kills per Game Type</h3>
    <div class="row">
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/seth-abner.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">Scump</a></span>
          <span class="player-detail">Hardpoint<em>47</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/matt-haag.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">Nadeshot</a></span>
          <span class="player-detail">SND<em>16</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/ian-porter.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="#">Crimsixian</a></span>
          <span class="player-detail">Uplink<em>32</em></span>
        </div>
      </div>
      <div class="col-xs-3 performer">
        <div class="player-pic">
          <img src="images/players/matthew-piper.jpg" alt="" />
        </div>
        <div class="player-info">
          <span class="player-name"><a href="player.php">Formal</a></span>
          <span class="player-detail">CTF<em>21</em></span>
        </div>
      </div>
    </div>

    <section id="records" class="section">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <table id="" class="data">
            <thead>
              <tr>
                <td>Game Type</td>
                <td>Map</td>
                <td>Player</td>
                <td>Kills</td>
                <td>Against</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>HP</td>
                <td>Breach</td>
                <td><a href="#"><img src="images/teams/dream-team.png" alt="" class="table-icon" />Player Name</a></td>
                <td>32</td>
                <td><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team Envyus</a></td>
              </tr>
              <tr>
                <td>HP</td>
                <td>Fringe</td>
                <td><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player Name</a></td>
                <td>32</td>
                <td><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Faze Clan</a></td>
              </tr>
              <tr>
                <td>HP</td>
                <td>Stronghold</td>
                <td><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Player Name</a></td>
                <td>32</td>
                <td><a href="#"><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Team Kaliber</a></td>
              </tr>
              <tr>
                <td>HP</td>
                <td>Evac</td>
                <td><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player Name</a></td>
                <td>32</td>
                <td><a href="#"><img src="images/teams/citadel-gaming.png" alt="" class="table-icon" />Citadel Gaming</a></td>
              </tr>
            </tbody>
          </table>  
        </div>        
      </div>
    </section>
  </div>

</section><!-- /event listings -->
@stop

@section('loadlast')
<script>
  $('#stat-tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
</script>
@stop
