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

</style>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box">

      <div class="box-header">
        <h3 class="box-title">CTF Caps</h3>
              <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
      </div><!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-condensed" id="cssTable">
          <tbody><tr>
            <th style="width: 10px"></th>
            <th style="width: 10px"></th>
            <th style="width: 10px; text-align: center;">Player</th>
            <th style="width: 10px; text-align: center;">Average Caps</th>
            <th style="width: 10px; text-align: center;">Total Caps</th>
            <th style="width: 10px; text-align: center;">Maps</th>
          </tr>
          <?php $i=1; ?>
          @foreach($ctfCapsPlayers as $player)
          <tr>
            <td><b>{!!$i!!}</b></td>
            <td>
              @if(!is_null($player->photo_url))
              <img class="player_img img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 75; width: 55;"/>
              @else
              <img class="player_img img-center img-responsive" src="http://codstreams.net/uploads/players/alt.png" style="height: 75; width: 55;"/>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/>  --> <b>{!!$player->alias!!}</b></td>
            <td><span class="badge bg-green">{!!$player->getCTFCapsAverage()!!}</span></td>
            <td><span class="badge bg-green">{!!$player->getCTFCapsTotal()!!}</span></td>
            <td><span class="badge bg-green">{!!$player->getCTFMapCount()!!}</span></td>
          </tr>
          <?php $i++; ?>
          @endforeach

        </tbody></table>
      </div><!-- /.box-body -->
    </div>
  </div>

  <div class="col-md-6">
    <div class="box">

      <div class="box-header">
        <h3 class="box-title">CTF K/D</h3>
              <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
      </div><!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-condensed" id="cssTable">
          <tbody><tr>
            <th style="width: 10px"></th>
            <th style="width: 10px"></th>
            <th style="width: 10px; text-align: center;">Player</th>
            <th style="width: 10px; text-align: center;">K/D</th>
            <th style="width: 10px; text-align: center;">Maps</th>
          </tr>
          <?php $i=1; ?>
          @foreach($ctfKDPlayers as $player)
          <tr>
            <td><b>{!!$i!!}</b></td>
            <td>
              @if(!is_null($player->photo_url))
              <img class="player_img img-center img-responsive" src="{!!$player->photo_url!!}" style="height: 75; width: 55;"/>
              @else
              <img class="player_img img-center img-responsive" src="http://codstreams.net/uploads/players/alt.png" style="height: 75; width: 55;"/>
              @endif
            </td>
            <td><!-- <img class="team_img" src='http://hydra-media.cursecdn.com/cod.gamepedia.com/4/48/Optic.png?version=55115f8ad615910a2ed282dac9a39edc' height='20'/>  --> <b>{!!$player->alias!!}</b></td>
            <td><span class="badge bg-green">{!!$player->getCTFKD()!!}</span></td>
            <td><span class="badge bg-green">{!!$player->getCTFMapCount()!!}</span></td>
          </tr>
          <?php $i++; ?>
          @endforeach

        </tbody></table>
      </div><!-- /.box-body -->
    </div>
  </div>





  @endsection