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

 .color {
  background-color: #101010 !important;
  border: 2px solid !important;
  
}

.image { 
 position: relative; 
 width: 100%; /* for IE 6 */
}

h2 { 
 position: absolute; 
 top: 200px; 
 left: 0; 
 width: 100%; 
}

h2 span { 
 color: white; 
 font: bold 24px/45px Helvetica, Sans-Serif; 
 letter-spacing: -1px;  
 background: rgb(196, 13, 13); /* fallback color */
 background: rgba(196, 12, 13, 0.7);
 padding: 10px; 
}
</style>
@endsection

@section('js')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

@endsection
@section('content')
<div id='header'>
 <img class="bg" src="http://teambeyond.net/wp-content/uploads/2014/02/optic-gaming-header.png" width='100%' height='200'/>
</div>
<div class='pad'></div>
<div class='row'>
  <div class='col-md-12'>
    <div class='row'>
      <div class='col-md-3'>
        @foreach($roster as $player)
        <div class="image">
          <img class="player_img img-center img-responsive" src="http://codstreams.net/uploads/players/alt.png" style="width: 100%;"/>
          <h2><span>{!!$player->player->alias!!}</span></h2>

        </div>
        <div class='pad'></div>
        @endforeach
      </div>
      








      @endsection
