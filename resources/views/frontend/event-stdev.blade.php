@extends('layouts.frontend')
@section('title')
  Standard Deviation Stats | {!!$event->name!!}
@stop
  
@section('banner')
{{--<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6">--}}
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
        <li><a href="{!!'/event/pickban/' . $event->id!!}">Pick/Bans</a></li>
        <li class="active"><a href="{!!'/event/stdev/' . $event->id!!}">STDEV Stats</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- EVENT DETAILS
================================================== -->
<section class="section gray stats event">
  <div class="wrap">

    <section id="game-types" class="section">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <table id="" class="data">
            <thead>
              <tr>
                <td class="title" colspan="2">Kills per Respawn</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Formal</a></td>
                <td>26.00</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.61</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.19</td>
              </tr>
              <tr>
                <td class="stdev above" colspan="2">Above (24.55)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Claystar</a></td>
                <td>24.40</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/dream-team.png" alt="" class="table-icon" />Player</a></td>
                <td>24.21</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.96</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.21</td>
              </tr>
              <tr>
                <td class="stdev average" colspan="2">Average (22.99)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Player</a></td>
                <td>22.16</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>21.54</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>2.28</td>
              </tr>
              <tr>
                <td class="stdev below" colspan="2">Below (20.24)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Player</a></td>
                <td>19.86</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/citadel-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>18.60</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Player</a></td>
                <td>18.29</td>
              </tr>
            </tbody>
          </table>  
        </div>  
        <div class="col-xs-12 col-sm-6 col-md-3">
          <table id="" class="data">
            <thead>
              <tr>
                <td class="title" colspan="2">SND K/D Ratio</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Formal</a></td>
                <td>26.00</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.61</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.19</td>
              </tr>
              <tr>
                <td class="stdev above" colspan="2">Above (24.55)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Claystar</a></td>
                <td>24.40</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/dream-team.png" alt="" class="table-icon" />Player</a></td>
                <td>24.21</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.96</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.21</td>
              </tr>
              <tr>
                <td class="stdev average" colspan="2">Average (22.99)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Player</a></td>
                <td>22.16</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>21.54</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>2.28</td>
              </tr>
              <tr>
                <td class="stdev below" colspan="2">Below (20.24)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Player</a></td>
                <td>19.86</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/citadel-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>18.60</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Player</a></td>
                <td>18.29</td>
              </tr>
            </tbody>
          </table>  
        </div>              
        <div class="col-xs-12 col-sm-6 col-md-3">
          <table id="" class="data">
            <thead>
              <tr>
                <td class="title" colspan="2">K/D Ratio</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Formal</a></td>
                <td>26.00</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.61</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.19</td>
              </tr>
              <tr>
                <td class="stdev above" colspan="2">Above (24.55)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Claystar</a></td>
                <td>24.40</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/dream-team.png" alt="" class="table-icon" />Player</a></td>
                <td>24.21</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.96</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.21</td>
              </tr>
              <tr>
                <td class="stdev average" colspan="2">Average (22.99)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Player</a></td>
                <td>22.16</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>21.54</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>2.28</td>
              </tr>
              <tr>
                <td class="stdev below" colspan="2">Below (20.24)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Player</a></td>
                <td>19.86</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/citadel-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>18.60</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Player</a></td>
                <td>18.29</td>
              </tr>
            </tbody>
          </table>  
        </div>  
        <div class="col-xs-12 col-sm-6 col-md-3">
          <table id="" class="data">
            <thead>
              <tr>
                <td class="title" colspan="2">CTF Caps per Game</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Formal</a></td>
                <td>26.00</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.61</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>25.19</td>
              </tr>
              <tr>
                <td class="stdev above" colspan="2">Above (24.55)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Claystar</a></td>
                <td>24.40</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/dream-team.png" alt="" class="table-icon" />Player</a></td>
                <td>24.21</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.96</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player</a></td>
                <td>23.21</td>
              </tr>
              <tr>
                <td class="stdev average" colspan="2">Average (22.99)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Player</a></td>
                <td>22.16</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Player</a></td>
                <td>21.54</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>2.28</td>
              </tr>
              <tr>
                <td class="stdev below" colspan="2">Below (20.24)</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Player</a></td>
                <td>19.86</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/citadel-gaming.png" alt="" class="table-icon" />Player</a></td>
                <td>18.60</td>
              </tr>
              <tr>
                <td class="title"><a href="#"><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Player</a></td>
                <td>18.29</td>
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
