<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Optic Gaming | Call of Duty Esports Statistics</title>
	<meta name="description" content="">

	@include('frontend.assets.head-links')
</head>
<body>

<!-- BANNER
================================================== -->
<div id="banner" style="background-image:url(images/banners/about.jpg);" data-type="background" data-speed="6">
	
	@include('frontend.assets.header') 

	<div class="banner-content event">
		<h1><img src="images/teams/optic-gaming.png" alt="" class="team-icon" />Optic Gaming</h1>
	</div>

</div><!-- /banner -->

<!-- ROSTER
================================================== -->
<section class="section">
	<div class="wrap">
		<h2>Roster</h2>
		<div class="row">
      @foreach($starters as $starter)
			<div class="col-xs-3 performer">
				<div class="player-pic">
					<img src="images/players/{!!$starter->photo_url!!}" alt="" />
				</div>
				<div class="player-info">
					<span class="player-name"><a href="player.php">{!!$starter->alias!!}</a></span>
					<span class="player-detail">{!!$starter->first_name . " " . $starter->last_name!!}</span>
				</div>
			</div>
      @endforeach
		</div>
		<section class="section">
			<h2>Event History</h2>
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<table id="kdr" class="data">
								<thead>
									<tr>
										<td class="title">Event</td>
										<td>Placing</td>									
										<td>Wins</td>
										<td>Losses</td>
										<td>Win %</td>
										<td>Map Wins</td>
										<td>Map Losses</td>
                                        {{--<td>K/D Ratio</td>--}}
									</tr>
								</thead>
								<tbody>
                  @foreach($rosterEvents as $rosterEvent)
									  <tr>
									  	<td class="title"><img src="images/events/cod-world-league.png" alt="" class="table-icon" /><a href="#">{!!$rosterEvent->event->name!!}</a></td>
                      {{--<td><span class="placing first">1</span></td>--}}
									  	<td>{!!$rosterEvent->placing!!}</td>
									  	<td>{!!$rosterEvent->wins!!}</td>
									  	<td>{!!$rosterEvent->losses!!}</td>
									  	<td>{!!$rosterEvent->win_percent!!}</td>
									  	<td>{!!$rosterEvent->map_wins!!}</td>
									  	<td>{!!$rosterEvent->map_losses!!}</td>
                                        {{--<td>{!!$rosterEvent->kd!!}</td>--}}
									  </tr>
                  @endforeach
								</tbody>
							</table>		
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</section><!-- /event listings -->

@include('frontend.assets.footer')

</body>
</html>

