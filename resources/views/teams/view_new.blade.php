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
  float: left;
  padding-right: -10px;
}

.pad {
  padding-left: 5px;
}
   </style>
@endsection

@section('js')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
@endsection
@section('content')
<div id='header'>
   <img class="bg" src="http://teambeyond.net/wp-content/uploads/2014/02/optic-gaming-header.png" width='100%'/>
</div>

<!-- <!-- @foreach($roster->mapping as $player)
<div class='row'>
  <div class='col-md-12'>
    <div class='box'>
      <div class='box-body'>
        <div class='row'>
  <div class='col-md-8'>
   <img class="player_img" src={{$player->player->age}}/>
 </div>
   
  <div class='col-md-4'>
    <div class="info-box bg-green">
      <div class="pad">
        <span class="info-box-text">Name</span>
        <span class="info-box-number">{{$player->player->FirstName . " " . $player->player->LastName}}</span>
      </div>
    </div>
  </div>
  <div class='col-md-4'>
    <div class="info-box bg-green">
      <div class="pad">
        <span class="info-box-text">Bio</span>
        <span class="info-box-number">{{$player->player->age}}</span>
        <span class="info-box-number">{{$player->player->hometown . ", " . $player->player->country}}</span>
      </div>
    </div>
  </div>
    <div class='col-md-4'>
    <div class="info-box bg-green">
      <div class="pad">
        <span class="info-box-text">Role</span>
        <span class="info-box-number">{{$player->player->role}}</span>
      </div>
    </div>
  </div>
      <div class='col-md-4'>
    <div class="info-box bg-green">
      <div class="pad">
        <span class="info-box-text">First Event</span>
        <span class="info-box-number">{{$player->player->firstEvent}}</span>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
-->


@endsection