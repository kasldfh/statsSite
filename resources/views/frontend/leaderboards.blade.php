<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leaderboards | Competitive Call of Duty Stats</title>
	<meta name="description" content="">
	
  @include('frontend.assets.head-links')
<style type="text/css">
table.sortable tbody {
    counter-reset: sortabletablescope;
}
table.sortable thead tr:before {
    content: "";
    display: table-cell;
}
table.sortable tbody tr:before {
	font-size:13px;
    content: counter(sortabletablescope);
    counter-increment: sortabletablescope;
    display: table-cell;
}
</style>
</head>
<body>

<!-- BANNER
================================================== -->
<div id="banner" style="background-image:url(/images/mlg-world-venue.jpg);" data-type="background" data-speed="6">
	
  @include('frontend.assets.header')

	<div class="banner-content event">
		<h1>{!!$event->name!!} LEADERBOARD</h1>
	</div>

</div><!-- /banner -->


<!-- LEADERBOARD
================================================== -->
<section class="section gray stats event">
	<div class="wrap">

		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<table id="kdr" class="data sortable">
							<thead>
								<tr>
									<td class="title">Player</td>
									<td>K/D</td>
									<td>HP Kills / Map</td>
									<td>SND K/D</td>
									<td>UL Dunks</td>
									<td>HP Time</td>
								</tr>
							</thead>
							<tbody>
                @foreach($players as $player)
<?php dd($player);?>
								  <tr>
								  	<td class="title"><a href=""><img src={!!"/images/teams/".$player->team_logo!!} alt="" class="table-icon" />{!!$player->alias!!}</a></td>
								  	<td>{!!$player->kd!!}</td>
								  	<td>{!!$player->hpkpm!!}</td>
								  	<td>{!!$player->sndkd!!}</td>
								  	<td>{!!$player->uplink_dunks!!}</td>
								  	<td>{!!$player->hp_time!!}</td>
								  </tr>
                @endforeach
							</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>
			
	</div>

</section><!-- /leaderboard -->

@include('frontend.assets.footer')
<script src="/frontend_assets/js/sortable.js"></script>

</body>
</html>

