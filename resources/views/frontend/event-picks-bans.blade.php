@extends('layouts.frontend')
@section('title')
  Pick/Ban Stats | {!!$event->name!!}
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
        <li><a href="{!!'/event/records/' . $event->id!!}">Records</a></li>
        <li><a href="{!!'/event/specialist/' . $event->id!!}">Specialists</a></li>
        <li class="active"><a href="{!!'/event/pickban/' . $event->id!!}">Pick/Bans</a></li>
        <li><a href="{!!'/event/stdev/' . $event->id!!}">STDEV Stats</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- EVENT DETAILS
================================================== -->
<section class="section gray stats event">
  <div class="wrap">

    <section id="specialists" class="section">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <table id="" class="data">
            <thead>
              <tr>
                <td class="title">Item</td>
                <td>1st Pick %<br/>(Ban or Protect)</td>
                <td>Ban %</td>
                <td>Protect %</td>
                <td>Ban W%</td>
                <td>1st Ban %</td>
                <td>1st Protect %</td>                
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title">Vesper</td>
                <td>63%</td>
                <td>18%</td>
                <td>54%</td>
                <td>32%</td>
                <td>21%</td>
                <td>11%</td>
              </tr>
              <tr>
                <td class="title">M8A7</td>
                <td>45</td>
                <td>45%</td>
                <td>35%</td>
                <td>35%</td>
                <td>13%</td>
                <td>21%</td>
              </tr>
              <tr>
                <td class="title">High Caliber</td>
                <td>84%</td>
                <td>0%</td>
                <td>50%</td>
                <td>11%</td>
                <td>11%</td>
                <td>0%</td>
              </tr>
              <tr>
                <td class="title">Rapid Fire</td>
                <td>5%</td>
                <td>3%</td>
                <td>3%</td>
                <td>58%</td>
                <td>11%</td>
                <td>59%</td>
              </tr>  
              <tr>
                <td class="title">Concussion</td>
                <td>63%</td>
                <td>18%</td>
                <td>54%</td>
                <td>79%</td>
                <td>0%</td>
                <td>47%</td>
              </tr>  
              <tr>
                <td class="title">Sheiva</td>
                <td>39%</td>
                <td>3%</td>
                <td>47%</td>
                <td>8%</td>
                <td>8%</td>
                <td>0%</td>
              </tr>    
            </tbody>
          </table>  
        </div>        
      </div>
    </section>
  </div>

</section><!-- /event listings -->
@stop

@section('scripts')
  <script>
  $('#stat-tabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
  </script>
@stop
