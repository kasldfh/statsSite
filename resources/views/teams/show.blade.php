
@extends('layouts.main')

@section('style')
	
@endsection

@section('js')
 <script>
 $(document).ready(function() {
    $('#example').dataTable({
    	"bFilter": false,
    	"bPaginate": false,
    	"bInfo" : false
    });
  });
 </script>
@endsection
@section('content')
	
	<div class="row">
		<div class="col-sm-2 col-md-2 col-lg-2"></div>	
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
			<div class="team-stats">
			<div class="panel panel-default" style="border-color: #{{$team->colorb}}">
			
			<div class="panel-heading" style="background-color: #{{$team->colorb}}"><center><h3>{{$team->TeamName}}<h3></center></div>
			<div class="panel-body" >
			<div class="row">
			@foreach($roster->mapping as $player)
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<center>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<img src="{{asset('assets/img/headshots/' . $player->player->PlayerID . '.png')}}" class="img-thumbnail" style="background: #{{$team->Color}};">
						</div>
					</div>
					<div class = "row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="headshot_text" style="color: #{{$team->Color}}">{{$player->player->PlayerName}}</span>
						</div>
					</div>
					<div class = "row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="headshot_text" style="color: #000000">{{$player->player->FirstName . " " . $player->player->LastName}}</span>
						</div>
					</div>
					<div class = "row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<span class="headshot_text" style="color: {{$team->Color}}">K/D: {{$player->player->overall_kd}}</span>
						</div>
					</div>
				</center>
				</div>
			@endforeach
			</div>
		</div>
		</div>
		</div>
	</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th>Player</th>
						<th>K/D</th>
						<th>Slayer</th>
						<th>SnD K/D</th>
		            </tr>
		        </thead>
 
		        <tbody>
		        	@foreach($roster->mapping as $player)
		            <tr>
		                <td>{{$player->player->PlayerName}}</td>
						<td>{{$player->player->overall_kd}}</td>
						<td>{{$player->player->slayer}}</td>
						<td>{{"snd"}}</td>
		            </tr>
		           	@endforeach
		        </tbody>
    		</table>
		</div>
	</div>
@endsection