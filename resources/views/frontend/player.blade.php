@extends('layouts.frontend')
@section('title')
  FIRST ALIAS LAST | Call of Duty Esports Statistics
@stop

@section('banner')
{{--<div id="banner" style="background-image:url(images/banners/articles.jpg);" data-type="background" data-speed="6">--}}
  
  <div class="wrap">
    <div class="player">
      <div class="row">
        <div class="col-xs-5 col-sm-3 col-md-3 player-pic">
          <img src="images/players/seth-abner.jpg" alt="" />
        </div>
        <div class="col-xs-7 col-sm-9 col-md-4 player-info">
          <h1>Scump</h1>
          <dl>
            <dt>Name</dt>
            <dd>Seth Abner</dd>
            <dt>Team</dt>
            <dd><a href="team.php"><img src="images/teams/optic-gaming.png" class="team-icon" alt="" /> Optic Gaming</a></dd>
            <dt>Avg. Placing</dt>
            <dd>1st</dd>
          </dl>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 player-stats">
          <div class="row">
            <div class="col-xs-4">
              <div class="stat-number">1.45</div>
              <div class="stat-type">K/D Ratio</div>
              <div class="stat-rank">#1 in WCL</div>
            </div>
            <div class="col-xs-4">
              <div class="stat-number">29</div>
              <div class="stat-type">Kills/Respawn</div>
              <div class="stat-rank">#1 in WCL</div>
            </div>
            <div class="col-xs-4">
              <div class="stat-number">3:40</div>
              <div class="stat-type">Time in HP</div>
              <div class="stat-rank">#1 in WCL</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')
<!-- ROSTER
================================================== -->
<section class="section">
  <div class="wrap">
    <p>Player stats needed</p>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <br/><br/><br/><br/><br/><br/><br/>
  </div>
</section><!-- /event listings -->
@stop
