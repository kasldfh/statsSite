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
        @foreach($games as $index=>$game)
          @if($index == 0)  
            <li class="active"><a href="">{!!$game->title!!}</a></li>
          @else
            <li><a href="">{!!$game->title!!}</a></li>
          @endif
        @endforeach

        {{--<li><a href="#">Advanced Warfare</a></li>--}}
        {{--<li><a href="#">Ghosts</a></li>--}}

      </ul>
    </nav>
  </div>
</header>

<!-- EVENT LISTINGS
================================================== -->
<section class="section listings">
  <div class="wrap">
  @foreach($games as $game)
    @foreach($game->events as $index => $event)
      @if($index %4 == 0)
        <div class="row">
      @endif
      <div class="col-xs-6 col-sm-3 col-md-3 listing event">
        <a href={!!"/event/" . $event->id!!}>
          <img src="images/events/cod-world-league.png" alt="" class="" />
          <h4>{!!$event->name!!}</h4>
          <span class="event-detail">{!!$event->description!!}</span>
        </a>
      </div>
      @if($index %4 == 0 && $index > 0)
        </div>
      @endif
    @endforeach
  @endforeach
  </div>
</section><!-- /event listings -->
@stop
