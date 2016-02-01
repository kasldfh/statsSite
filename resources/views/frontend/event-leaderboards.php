<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leaderboards | COD World League NA Qualifier</title>
	<meta name="description" content="">
	
	<?php include("assets/head-links.php"); ?>

</head>
<body>

<!-- BANNER
================================================== -->
<div id="banner" style="background-image:url(images/mlg-world-venue.jpg);" data-type="background" data-speed="6">
	
	<?php include("assets/header.php"); ?>

	<div class="banner-content event">
		<img src="images/events/cod-world-league.png" alt="" />
	</div>
	<a href="#" class="photo-credit">Photograph by @somebody123</a>	

</div><!-- /banner -->

<header class="details">
	<div class="wrap">
		<nav class="section-nav">
			<ul>
				<li><a href="event.php">Standings</a></li>
				<li class="active"><a href="event-leaderboards.php">Leaderboards</a></li>
				<li><a href="event-game-type.php">Game Type</a></li>
				<li><a href="event-records.php">Records</a></li>
				<li><a href="event-specialists.php">Specialists</a></li>
				<li><a href="event-picks-bans.php">Pick/Bans</a></li>
				<li><a href="event-stdev.php">STDEV Stats</a></li>
			</ul>
		</nav>
	</div>
</header>

<!-- EVENT DETAILS
================================================== -->
<section class="section gray stats event">
	<div class="wrap">

		<section id="game-types" class="section">
			<nav class="tabs">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#kd" aria-controls="kd" role="tab" data-toggle="tab">K/D Ratio</a></li>
					<li><a href="#slayer" aria-controls="slayer" role="tab" data-toggle="tab">Slayer</a></li>
					<li><a href="#ctf" aria-controls="ctf" role="tab" data-toggle="tab">CTF Captures</a></li>
					<li><a href="#hptime" aria-controls="hptime" role="tab" data-toggle="tab">HP Time in Hill</a></li>
					<li><a href="#uplink-caps" aria-controls="uplink-caps" role="tab" data-toggle="tab">Uplink Caps</a></li>
				</ul>
			</nav>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="kd">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td>Rank</td>
										<td class="title">Player</td>
										<td>K/D</td>
										<td>K</td>
										<td>D</td>
										<td>Maps</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Formal</a></td>
										<td>1.19</td>
										<td>119</td>
										<td>100</td>
										<td>34</td>
									</tr>
									<tr>
										<td>2</td>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
										<td>1.00</td>
										<td>85</td>
										<td>85</td>
										<td>20</td>
									</tr>
									<tr>
										<td>3</td>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
										<td>1.00</td>
										<td>85</td>
										<td>85</td>
										<td>20</td>
									</tr>
									<tr>
										<td>4</td>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
										<td>1.00</td>
										<td>85</td>
										<td>85</td>
										<td>20</td>
									</tr>
									<tr>
										<td>5</td>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player</a></td>
										<td>1.00</td>
										<td>85</td>
										<td>85</td>
										<td>20</td>
									</tr>
								</tbody>
							</table>	
						</div>				
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="slayer">
					...slayer stats...
				</div>
				<div role="tabpanel" class="tab-pane" id="ctf">
					...ctf stats...
				</div>
				<div role="tabpanel" class="tab-pane" id="hptime">
					...hp time in hill stats...
				</div>
				<div role="tabpanel" class="tab-pane" id="uplink-caps">
					...uplink cap stats...
				</div>
			</div>
		</section>
	</div>

</section><!-- /event listings -->

<?php include("assets/footer.php"); ?>
<script>
$('#stat-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>

</body>
</html>

