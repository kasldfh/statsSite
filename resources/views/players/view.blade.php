@extends('layouts.main')

@section('style')
<style type="text/css">
.bg {
  padding-top: -25px;
  padding-left: -25px;
  padding-bottom: 20px;
  width: 100%;
}

.player_img {
  width: 100%;
  padding-right: -10px;  
  border-radius: 11px 11px 11px 11px;
  -moz-border-radius: 11px 11px 11px 11px;
  -webkit-border-radius: 11px 11px 11px 11px;
  border: 7px outset #f2f2f2;
}

.pad {
  padding-top: 15px;
}

.nav nav-tabs { 
  height: 2.35em; 
  text-align: center; 
} 
.nav nav-tabs li { 
  display: inline-block; 
  float: none; 
  top: 0px; 
  margin: 0em; 
}
.img-center {margin:0 auto;}

.shadow {
 -moz-box-shadow:    inset 0 0 10px #000000 !important;
 -webkit-box-shadow: inset 0 0 10px #000000 !important; 
 box-shadow:         inset 0 0 10px #000000 !important;}

 .team_color {
  background-color: {{$color}} !important;
 }

 .color {
  background-color: #282828 !important;
  border: 4px solid !important;
  border-color: {{$color}} !important;
  
 }

 .white {
  color: #FFFFFF !important;
 }
 </style>
 @endsection

 @section('js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <script>
 $(function() {
  $( "#tabs" ).tabs(); 
  var ctx = document.getElementById("kd_graph").getContext("2d");
  var data = {
    labels: ["{{$player->alias}}'s K/D", "Team's Average K/D", "Average K/D", "Highest K/D ({{$highest->alias}})"],
    datasets: [
        {
            label: "KD",
            fillColor: "rgba(170,170,170,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(170,170,170,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [{{$player->kd}}, {{$team}}, {{$average}}, {{$highest->kd}}]
        }
    ]
  };
  var chart = new Chart(ctx).Bar(data, {
      maintainAspectRatio: true,
      responsive: true

    });
  chart.datasets[0].bars[0].fillColor =  "rgba(170,0,0,0.5)";
  chart.datasets[0].bars[0].highlightFill =  "rgba(170,0,0,0.75)";
  chart.update();
   var ctx2 = document.getElementById("event_graph").getContext("2d");
  var labels = {{json_encode($event_names)}};
  var dataset = {{json_encode($event_kd)}};
  var data = {
    labels: labels,
    datasets: [
        {
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: dataset
        },
    ]
};
  var myNewChart = new Chart(ctx2).Line(data, {
    maintainAspectRatio: true,
    responsive: true
  });
});


 </script>
 @endsection
 @section('content')
 <div class='pad'></div>
 <div class='row'>
  <div class='col-md-12'>
    <div class='row'>
      <div class='col-md-4'>
        @if(!is_null($player->photo_url))
        <img class="player_img img-center img-responsive" src="{{$player->photo_url}}" style="width: 75%;"/>
        @else
        <img class="player_img img-center img-responsive" src="http://codstreams.net/uploads/players/alt.png" style="width: 75%;"/>
        @endif
      </div>

      <div class='col-md-4'>
        <div class="info-box color">
          <div class="pad">
            <span class="info-box-text white">Name</span>
            <span class="info-box-number white">
              @if($player->first_name != '' && $player->last_name != '')
              {{$player->first_name}} "{{$player->alias}}" {{$player->last_name}}
              @else
              {{$player->alias}}
              @endif
            </span>
          </div>
        </div>
        <div class="info-box color">
          <div class="pad">
            <span class="info-box-text white">Bio</span>
            @if($team != ' ')
            <span class="info-box-number white">{{$team_name}}</span>
            @else
            <span class="info-box-number white">F/A</span>
            @endif
            @if($player->age != 0)
            <span class="info-box-number white">{{$player->age}}</span>
            @endif
            @if($player->hometown != '')
            <span class="info-box-number white">{{$player->hometown.", ".$player->country}}</span>
            @else
            <span class="info-box-number white">{{$player->country}}</span>
            @endif
          </div>
        </div>
        <div class="info-box color">
          <div class="pad">
            <span class="info-box-text white">Role</span>
            @if($player->role != '')
            <span class="info-box-number white">{{$player->role}}</span>
            @else
            <span class="info-box-number white">?</span>
            @endif
          </div>
        </div>
        <div class="info-box color">
          <div class="pad">
            <span class="info-box-text white">First Event</span>
            @if($player->first_event != '')
            <span class="info-box-number white">{{$player->first_event}}</span>
            @else
            <span class="info-box-number white">?</span>
            @endif
          </div>
        </div>
      </div>
      <div class ="col-md-4">
       <a class="twitter-timeline"
       width="400"
       height="400"
       href="#"
       data-widget-id="{{$player->twitter_widget}}">
       <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
     </a>
   </div>
 </div>

 <div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="shadow info-box">
      <span class=" shadow info-box-icon team_color"><b>K/D</b></span>
      <div class="info-box-content">
        <span class="info-box-text">K/D Ratio</span>
        <span class="info-box-number">{{$player->kd}}</span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="shadow info-box">
      <span class=" shadow info-box-icon team_color"><b>Slay</b></span>
      <div class="info-box-content">
        <span class="info-box-text">Slayer</span>
        <span class="info-box-number">{{$player->slayer}}</span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="shadow info-box">
      <span class=" shadow info-box-icon team_color"><b>SnD</b></span>
      <div class="info-box-content">
        <span class="info-box-text">SnD K/D Ratio</span>
        <span class="info-box-number">{{$player->sndkd}}</span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="shadow info-box">
      <span class=" shadow info-box-icon team_color"><b>R/E</b></span>
      <div class="info-box-content">
        <span class="info-box-text">Respawn Efficiency</span>
        <span class="info-box-number">{{$player->respawn}}</span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="clearfix">
      <span class="pull-left">First Blood %</span>
      <small class="pull-right">{{$player->fb}}%</small>
    </div>
    <div class="progress">
      <div class="progress-bar team_color" style="width: {{$player->fb}}%;"></div>
    </div>
  </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="clearfix">
      <span class="pull-left">SnD Bomb Plant %</span>
      <small class="pull-right">{{$player->plant}}%</small>
    </div>
    <div class="progress">
      <div class="progress-bar team_color" style="width: {{$player->plant}}%;"></div>
    </div>
  </div>
</div>
<div class="row">
  
  <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
    <label for = "kd_graph">
    K/D Breakdown<br /></label>
    <canvas id="kd_graph" height="200"></canvas>

  </div>
  <div class="col-lg-1"></div>
  <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
    <label for = "event_graph">
    Last {{count($event_names)}} Events<br /></label>
    <canvas id="event_graph" height="180"></canvas>
  </div>
</div>
 <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      {{link_to_action('FrontEndPlayerController@viewDetailed', "View Detailed Statistics", ['id' => strtolower($player->alias)], ["class" => "btn btn-block btn-default"])}}
    </div>
  </div>







@endsection