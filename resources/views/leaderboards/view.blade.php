@extends('layouts.main')

@section('style')
<style type="text/css">

.row {
  padding-top: 10px;
}
.box-title {
  color: black;
  text-align: center;
}

.player_img{border:1px solid #;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  vertical-align: middle;
}

.team_img{
  padding-right: 5px;
}

#cssTable td 
{
  vertical-align:middle;
  text-align: center;
}

.img-center {margin:0 auto;}

.gold {
  border-left: 5px solid #DBB727;
  border-bottom: 6px solid white;
}

.silver {
  border-left: 5px solid #807E79;
  border-bottom: 6px solid white;
}

.bronze {
  border-left: 5px solid #CD7F32;
  border-bottom: 6px solid white;
}
</style>
@endsection

@section('js')
@endsection
@section('content')
@if(isset($event))
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h4 class="text" style="color:#000000; font-size: 25px;">{!!$event->name!!} - Leaderboard</h4>
  </div>
</div>
@endif
<div class="row">
  <div class="col-md-4">
    <div class="box">

      <div class="box-header">
        <h3 class="box-title">Overall K/D Leaderboard</h3>
              <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
      </div><!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-condensed" id="cssTable">
          <tbody><tr>
            <th style="width: 10px"></th>
            <th style="width: 10px"></th>
            <th style="width: 20px; text-align: center;">Player</th>
            <th style="width: 10px; text-align: center;">K/D</th>
            <th style="width: 10px; text-align: center;">Maps</th>
          </tr>
          <?php $i=1; ?>
          @foreach($players as $player)
          @if($i<=25)
          <tr>
            <td
            @if($i <= 3)
            class="gold"
            @elseif($i<=10)
            class="silver"
            @else
            class="bronze"
            @endif
            ><b>{!!$i!!}</b></td>
            <td>
              @if(!is_null($player->photo_url))
              <img class="player_img img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 75; width: 55;"/>
              @else
              <img class="player_img img-center img-responsive" src="{{ URL::to('/') }}/assets/img/default.png" style="height: 75; width: 55;"/>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/>  --> 
              @if(count($player->rostermap) > 0)
                <span class="flair flair-{!! $player->rostermap[0]->roster->team->flair !!}"></span>

              @else
               <span class="flair flair-fa"></span>
              @endif
              <b>{!!$player->alias!!}</b></td>
              @if(isset($event))
                <td><span class="">{!!$player->kdByEvent($event->id)!!}</span></td>
            <td><span class="">{!!$player->getMapCountByEvent($event->id)!!}</span></td>
<!-- came from under this if statement-->
              @else
                <td><span class="">{!!$player->kd!!}</span></td>
              @endif
          </tr>
          <?php $i++; ?>
          @endif
          @endforeach

        </tbody></table>
      </div><!-- /.box-body -->
    </div>
  </div>

  <div class="col-md-4">
    <div class="box">

      <div class="box-header">
        <h3 class="box-title">Slayer Leaderboard</h3>
              <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
      </div><!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-condensed" id="cssTable">
          <tbody><tr>
            <th style="width: 10px"></th>
            <th style="width: 30px"></th>
            <th style="width: 20px; text-align: center;">Player</th>
            <th style="width: 10px; text-align: center;">Slayer</th>
            <th style="width: 10px; text-align: center;">Maps</th>

          </tr>
          <?php $j=1; ?>
          @foreach($slayers as $player)
          @if($j<=25)
          <tr>
            <td
            @if($j <= 3)
            class="gold"
            @elseif($j <=10)
            class="silver"
            @else
            class="bronze"
            @endif
            ><b>{!!$j!!}</b></td>
            <td>              
              @if(!is_null($player->photo_url))
              <img class="player_img img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 75; width: 55;"/>
              @else
              <img class="player_img img-center img-responsive" src="{{ URL::to('/') }}/assets/img/default.png" style="height: 75; width: 55;"/>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/> -->  
               @if(count($player->rostermap) > 0)
                <span class="flair flair-{!! $player->rostermap[0]->roster->team->flair !!}"></span>

              @else
               <span class="flair flair-fa"></span>
              @endif
              <b>{!!$player->alias!!}</b></td>
              @if(isset($event))
                <td><span class="">{!!$player->slayerByEvent($event->id)!!}</span></td>
            <td><span class="">{!!$player->getRespawnMapCountByEvent($event->id)!!}</span></td>
<!-- came from under ifelse -->
              @else
                <td><span class="">{!!$player->slayer!!}</span></td>
              @endif
          </tr>
          <?php $j++; ?>
          @endif
          @endforeach

        </tbody></table>
      </div><!-- /.box-body -->
    </div>
  </div>

  <div class="col-md-4">
    <div class="box">

      <div class="box-header">
        <h3 class="box-title">SnD K/D Leaderboard</h3>
              <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
      </div><!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-condensed" id="cssTable">
          <tbody><tr>
            <th style="width: 10px"></th>
            <th style="width: 30px"></th>
            <th style="width: 20px; text-align: center;">Player</th>
            <th style="width: 10px; text-align: center;">K/D</th>
            <th style="width: 10px; text-align: center;">Maps</th>

          </tr>
          <?php $k=1; ?>
          @foreach($sndPlayers as $player)
          @if($k<=25)
          
            <td
	      	@if($k <= 3)
		class="gold"
		@elseif($k <= 10)
		class="silver"
		@else
		class="bronze"
		@endif
		><b>{!!$k!!}</b></td>
            <td>              
              @if(!is_null($player->photo_url))
              <img class="player_img img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 75; width: 55;"/>
              @else
              <img class="player_img img-center img-responsive" src="{{ URL::to('/') }}/assets/img/default.png" style="height: 75; width: 55;"/>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/> -->  
               @if(count($player->rostermap) > 0)
                <span class="flair flair-{!! $player->rostermap[0]->roster->team->flair !!}"></span>

              @else
               <span class="flair flair-fa"></span>
              @endif
              <b>{!!$player->alias!!}</b></td>

              @if(isset($event))
                <td><span class="">{!!$player->sndkdByEvent($event->id)!!}</span></td>
            <td><span class="">{!!$player->getSndMapCountByEvent($event->id)!!}</span></td>
<!-- came from under this if statement-->
              @else
                <td><span class="">{!!$player->sndkd!!}</span></td>
              @endif
          </tr>
          <?php $k++; ?>
          @endif
          @endforeach

        </tbody></table>
      </div><!-- /.box-body -->
    </div>
  </div>
 


 
@endsection
