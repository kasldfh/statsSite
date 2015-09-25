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
    <header class="header bg-light b-b">
        <p>Leaderboards - Overall</p>
    </header>
@if(isset($event))
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h4 class="text" style="color:#000000; font-size: 25px;">{!!$event->name!!} - Leaderboard</h4>
  </div>
</div>
@endif
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="panel b-a" style="box-shadow: inset 0px -31px 55px -13px rgba(44,224,27,0.27);">
            <div class="panel-heading bg-primary text-center">
                <a href="#">
                    <i class="fa fa-star icon">
                    </i> Top KDR
                </a>
            </div>
            <div class="padder-v text-center clearfix">
                <div class="col-xs-3 b-r" style="">
                    <div class="thumb avatar"><img src="{!!asset('assets/img/headshots/1.png')!!}" style="width: 50px; height: 50px;"/></div>
                </div>
                <div class="col-xs-4 b-r">
                    <div class="h3 font-bold">2.12</div>
                    <small class="text-muted">KD/R</small>
                </div>

                <div class="col-xs-5">
                    <div class="h3 font-bold">Scump</div>
                    <small class="text-muted">Player</small>
                </div>
            </div>
            <div class="text-xs text-center m-b-sm"> OpTic gaming</div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="panel b-a" style="box-shadow: inset 0px -31px 55px -13px rgba(222,29,29,0.27);">
            <div class="panel-heading bg-primary text-center">
                <a href="#">
                    <i class="fa fa-star icon">
                    </i> Top Slayer
                </a>
            </div>
            <div class="padder-v text-center clearfix">
                <div class="col-xs-3 b-r">
                    <div class="thumb avatar"><img src="{!!asset('assets/img/headshots/4.png')!!}" style="width: 50px; height: 50px;"/></div>
                </div>
                <div class="col-xs-4 b-r">
                    <div class="h3 font-bold">343</div>
                    <small class="text-muted">Slay</small>
                </div>
                <div class="col-xs-5">
                    <div class="h3 font-bold">Nadeshot</div>
                    <small class="text-muted">Player</small>
                </div>

            </div>
            <div class="text-xs text-center m-b-sm">FaZe Red</div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="panel b-a" style="box-shadow: inset 0px -31px 55px -13px rgba(44,224,27,.27);" >
            <div class="panel-heading bg-primary text-center">
                <a href="#">
                    <i class="fa fa-star icon">
                    </i>  Top S&D
                </a>
            </div>
            <div class="padder-v text-center clearfix" >
                <div class="col-xs-3 b-r">
                    <div class="thumb avatar"><img src="{!!asset('assets/img/headshots/5.png')!!}" style="width: 50px; height: 50px;"/></div>
                </div>
                <div class="col-xs-4 b-r">
                    <div class="h3 font-bold">1.22</div>
                    <small class="text-muted">KD/R</small>
                </div>
                <div class="col-xs-5">
                    <div class="h3 font-bold">Clayster</div>
                    <small class="text-muted">Player</small>
                </div>

            </div>
            <div class="text-xs text-center m-b-sm">OpTic Gaming</div>
        </div>
    </div>
</div>
<div class="row panel">
  <div class="col-md-4">
      <div class="no-padding">
          <section class="panel b-a">
              <header class="panel-heading bg-light">

                  Overall K/D Leaderboard
              </header>
          <table class="table table-striped">
          <tbody><tr>
            <th style="width: 10px"></th>
            <th style="width: 10px"></th>
            <th style="width: 10px; text-align: center;">Player</th>
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
              <div class="thumb avatar"><img class="img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 35; width: 35;"/></div>
              @else
                    <div class="thumb avatar"><img class="img-center img-responsive" src="{{ URL::to('/') }}/assets/img/default.png" style="height: 35; width: 35;"/></div>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/>  --> 
              @if(count($player->rostermap) > 0)
                <span class="flair flair-{!! $player->rostermap[0]->roster->team->flair !!}"></span>

              @else
               <span class="flair flair-fa"></span>
              @endif
              {!!$player->alias!!}</td>
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

        </tbody></table></section>
      </div><!-- /.box-body -->
    </div>

  <div class="col-md-4">
          <div class="no-padding">
              <section class="panel b-a">
                  <header class="panel-heading bg-light">

                      Slayer leaderboard
                  </header>
                  <table class="table table-striped">
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
                    <div class="thumb avatar"><img class="img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 35; width: 35;"/></div>
              @else
                    <div class="thumb avatar"><img class="img-center img-responsive" src="{{ URL::to('/') }}/assets/img/default.png" style="height: 35; width: 35;"/></div>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/> -->  
               @if(count($player->rostermap) > 0)
                <span class="flair flair-{!! $player->rostermap[0]->roster->team->flair !!}"></span>

              @else
               <span class="flair flair-fa"></span>
              @endif
              {!!$player->alias!!}</td>
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

  <div class="col-md-4">
      <div class="no-padding">
          <section class="panel b-a">
              <header class="panel-heading bg-light">

                  S&D K/D Leaderboard
              </header>
              <table class="table table-striped">
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
                    <div class="thumb avatar"><img class="img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 35; width: 35;"/></div>
                @else
                    <div class="thumb avatar"><img class="img-center img-responsive" src="{{ URL::to('/') }}/assets/img/default.png" style="height: 35; width: 35;"/></div>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/> -->  
               @if(count($player->rostermap) > 0)
                <span class="flair flair-{!! $player->rostermap[0]->roster->team->flair !!}"></span>

              @else
               <span class="flair flair-fa"></span>
              @endif
              {!!$player->alias!!}</td>

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
