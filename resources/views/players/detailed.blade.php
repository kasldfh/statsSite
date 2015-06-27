@extends('layouts.main')

@section('style')

@endsection

@section('js')
@endsection

@section('content')

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="player-header">
      <div class="player-inner">
      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
        @if(!is_null($player->photo_url))
        <img class="player_img img-center img-responsive clip" src="{!!$player->photo_url!!}" style=""/>
        @else
        <img class="player_img img-center img-responsive clip" src="http://codstreams.net/uploads/players/alt.png" style=""/>
        @endif
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <div class="player-name">
                <h4 class="text larger">
                @if($player->first_name != '' && $player->last_name != '')
                {!!$player->first_name!!}</br>"{!!$player->alias!!}"</br>{!!$player->last_name!!}
                @else
                {!!$player->alias!!}
                @endif
                </h4>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <h4 class="text">
                    @if($player->role != '')
                    {!!$player->role!!} / {!!$team_name!!}
                    @else
                    {!!$team_name!!}
                    @endif
                  </h4>
                </div>
              </div>
            </div>
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4">
              @if($player->age != 0)
              <h5 class="text">Age: {!!$player->age!!}</h5>
              @endif
              @if($player->hometown != '')
              <h5 class="text">Location: {!!$player->hometown.", ".$player->country!!}</h5>
              @else
              <span class="info-box-number white">Location: {!!$player->country!!}</span>
              @endif
              <h5 class="text">K/D Ratio: {!!$player->kd!!}</h5>
              <h5 class="text">Slayer: {!!$player->slayer!!}</h5>
              <h5 class="text">SND K/D Ratio: {!!$player->sndkd!!}</h5>
            </div>
          </div>
          
          
          </div>
          <div class="hidden-xs hidden-sm col-md-2 col-lg-2">
            @if(isset($team) && $team->logo_url != '')
            <img src="{!!$team->logo_url!!}"class="pull-right img-responsive" style="width: 100%; padding-right:10px;">
            @endif
          </div>
        </div>
    
      </div>

    </div>
  </div>
</div>

@endsection
