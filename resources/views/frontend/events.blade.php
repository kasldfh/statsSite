@extends('layouts.frontend')
@section('title')
  {{--TODO: name of most current game here--}}
  Events  
@stop
{{--<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6">--}}
@section('banner')
    <h1>Events</h1>
@stop

@section('content')
<header class="details">
  <div class="wrap">
    <nav class="section-nav">
      <ul>
        <li class="active"><a href="events.php">Black Ops 3</a></li>
        <li><a href="#">Advanced Warfare</a></li>
        <li><a href="#">Ghosts</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- EVENT LISTINGS
================================================== -->
<section class="section listings">
  <div class="wrap">

    <div class="row">
      <div class="col-xs-6 col-sm-3 col-md-3 listing event">
        <a href="event.php">
          <img src="images/events/cod-world-league.png" alt="" class="" />
          <h4>COD World League NA Qualifier</h4>
          <span class="event-detail">Groups A &amp; B</span>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-3 listing event">
        <a href="event.php">
          <img src="images/events/cod-world-league.png" alt="" class="" />
          <h4>COD World League NA Qualifier</h4>
          <span class="event-detail">Groups C &amp; D</span>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-3 listing event">
        <a href="event.php">
          <img src="images/events/cod-world-league.png" alt="" class="" />
          <h4>EU World League Qualifier</h4>
          <span class="event-detail"></span>
        </a>
      </div>
      <div class="col-xs-6 col-sm-3 col-md-3 listing event">
        <a href="event.php">
          <img src="images/events/cod-world-league.png" alt="" class="" />
          <h4>EU COD World League</h4>
          <span class="event-detail"></span>
        </a>
      </div>
    </div>

  </div>
</section><!-- /event listings -->
@stop
