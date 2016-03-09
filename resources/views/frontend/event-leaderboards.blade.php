@extends('layouts.frontend')
@section('title')
  Leaderboards | {!!$event->name!!}
@stop

{{--<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6"> --}}
  

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
        <li class="active"><a href="{!!'/event/leaderboard/' . $event->id!!}">Leaderboards</a></li>
        <li><a href="{!!'/event/GameTypeStats/' . $event->id!!}">Game Type</a></li>
        <li><a href="{!!'/event/records/' . $event->id!!}">Records</a></li>
        <li><a href="{!!'/event/specialist/' . $event->id!!}">Specialists</a></li>
        <li><a href="{!!'/event/pickban/' . $event->id!!}">Pick/Bans</a></li>
        <li><a href="{!!'/event/stdev/' . $event->id!!}">STDEV Stats</a></li>
      </ul>
    </nav>
  </div>
</header>

<section class="section gray stats event">
  <div class="wrap">
    @include('frontend.leaderboard')
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
