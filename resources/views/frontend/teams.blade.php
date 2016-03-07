@extends('layouts.frontend')
@section('title')
  Team Listings | Call of Duty Esports Statistics
@stop

@section('banner')
{{--<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6">--}}
    <h1>Teams</h1>
@stop

@section('content')
<header class="details">
  <div class="wrap">
    <nav class="section-nav">
      <ul>
        <li class="active"><a href="#">North America</a></li>
        <li><a href="#">Europe</a></li>
        <li><a href="#">Australia/New Zealand</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- EVENT LISTINGS
================================================== -->
<section class="section listings">
  <div class="wrap">

    <div class="row">
      <div class="col-xs-6 col-sm-3 col-md-2 listing event">
        <a href="team.php">
          <img src="images/teams/optic-gaming.png" alt="" />
          <h5>Optic Gaming</h5>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-2 listing event">
        <a href="team.php">
          <img src="images/teams/denial-esports.png" alt="" />
          <h5>Denial Esports</h5>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-2 listing event">
        <a href="team.php">
          <img src="images/teams/team-envyus.png" alt="" />
          <h5>Team Envyus</h5>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-2 listing event">
        <a href="team.php">
          <img src="images/teams/faze-clan.png" alt="" />
          <h5>FaZe Clan</h5>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-2 listing event">
        <a href="team.php">
          <img src="images/teams/team-elevate.png" alt="" />
          <h5>Elevate</h5>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-2 listing event">
        <a href="team.php">
          <img src="images/teams/team-justus.png" alt="" />
          <h5>JustUs</h5>
        </a>
      </div>
    </div>
  </div>

</section><!-- /event listings -->
@stop
