@extends('layouts.frontend')
@section('title')
  Specialist Stats | {!!$event->name!!}
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
        <li><a href="event.php">Standings</a></li>
        <li><a href="event-leaderboards.php">Leaderboards</a></li>
        <li><a href="event-game-type.php">Game Type</a></li>
        <li><a href="event-records.php">Records</a></li>
        <li class="active"><a href="event-specialists.php">Specialists</a></li>
        <li><a href="event-picks-bans.php">Pick/Bans</a></li>
        <li><a href="event-stdev.php">STDEV Stats</a></li>
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
                <td class="title">Specialist</td>
                <td>K/D</td>
                <td>Slayer</td>
                <td>Avg HP Time</td>
                <td>HP Defends</td>
                <td>HP K/D</td>
                <td>UL Carries</td>
                <td>UL Throws</td>
                <td>UL Points</td>
                <td>UL K/D</td>
                <td>SND K/D</td>
                <td>SND Plants</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title">Active Camo</td>
                <td>1.17</td>
                <td>1.17</td>
                <td>0:00</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>1.71</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>1.06</td>
                <td>1.18</td>
                <td>0.33</td>
              </tr>
              <tr>
                <td class="title">Tempest</td>
                <td>1.02</td>
                <td>1.02</td>
                <td>1:22</td>
                <td>0.00</td>
                <td>1.05</td>
                <td>1.10</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>1.04</td>
                <td>0.44</td>
                <td>0.00</td>
              </tr>  
              <tr>
                <td class="title">Kinetic Armor</td>
                <td>1.02</td>
                <td>1.02</td>
                <td>1:22</td>
                <td>0.00</td>
                <td>1.05</td>
                <td>1.10</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>1.04</td>
                <td>0.44</td>
                <td>0.00</td>
              </tr>  
              <tr>
                <td class="title">Overdrive</td>
                <td>1.02</td>
                <td>1.02</td>
                <td>1:22</td>
                <td>0.00</td>
                <td>1.05</td>
                <td>1.10</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>1.04</td>
                <td>0.44</td>
                <td>0.00</td>
              </tr>
              <tr>
                <td class="title">Scythe</td>
                <td>1.02</td>
                <td>1.02</td>
                <td>1:22</td>
                <td>0.00</td>
                <td>1.05</td>
                <td>1.10</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>1.04</td>
                <td>0.44</td>
                <td>0.00</td>
              </tr>    
            </tbody>
          </table>  
        </div>        
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <table id="" class="data">
            <thead>
              <tr>
                <td class="title">Specialist</td>
                <td>Picked</td>
                <td>Pick Rate Per <br/>Other Specalist</td>
                <td>Pick Rate per Map</td>
                <td>HP</td>
                <td>SND</td>
                <td>UL</td>
                <td>CTF</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="title">Gravity Spikes</td>
                <td>6</td>
                <td>2%</td>
                <td>16%</td>
                <td>6</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
              <tr>
                <td class="title">Overdrive</td>
                <td>25</td>
                <td>8%</td>
                <td>34%</td>
                <td>1</td>
                <td>18</td>
                <td>4</td>
                <td>2</td>
              </tr>
              <tr>
                <td class="title">Sparrow</td>
                <td>2</td>
                <td>1%</td>
                <td>5%</td>
                <td>0</td>
                <td>0</td>
                <td>2</td>
                <td>0</td>
              </tr>
              <tr>
                <td class="title">Vision Pulse</td>
                <td>0</td>
                <td>0%</td>
                <td>0%</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
              <tr>
                <td class="title">Tempest</td>
                <td>24</td>
                <td>8%</td>
                <td>50%</td>
                <td>7</td>
                <td>1</td>
                <td>10</td>
                <td>6</td>
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
