<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event Records | COD World League NA Qualifier</title>
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
				<li><a href="event-leaderboards.php">Leaderboards</a></li>
				<li><a href="event-game-type.php">Game Type</a></li>
				<li class="active"><a href="event-records.php">Records</a></li>
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

		<h3>Most Kills per Game Type</h3>
		<div class="row">
			<div class="col-xs-3 performer">
				<div class="player-pic">
					<img src="images/players/seth-abner.jpg" alt="" />
				</div>
				<div class="player-info">
					<span class="player-name"><a href="player.php">Scump</a></span>
					<span class="player-detail">Hardpoint<em>47</em></span>
				</div>
			</div>
			<div class="col-xs-3 performer">
				<div class="player-pic">
					<img src="images/players/matt-haag.jpg" alt="" />
				</div>
				<div class="player-info">
					<span class="player-name"><a href="player.php">Nadeshot</a></span>
					<span class="player-detail">SND<em>16</em></span>
				</div>
			</div>
			<div class="col-xs-3 performer">
				<div class="player-pic">
					<img src="images/players/ian-porter.jpg" alt="" />
				</div>
				<div class="player-info">
					<span class="player-name"><a href="#">Crimsixian</a></span>
					<span class="player-detail">Uplink<em>32</em></span>
				</div>
			</div>
			<div class="col-xs-3 performer">
				<div class="player-pic">
					<img src="images/players/matthew-piper.jpg" alt="" />
				</div>
				<div class="player-info">
					<span class="player-name"><a href="player.php">Formal</a></span>
					<span class="player-detail">CTF<em>21</em></span>
				</div>
			</div>
		</div>

		<section id="records" class="section">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<table id="" class="data">
						<thead>
							<tr>
								<td>Game Type</td>
								<td>Map</td>
								<td>Player</td>
								<td>Kills</td>
								<td>Against</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>HP</td>
								<td>Breach</td>
								<td><a href="#"><img src="images/teams/dream-team.png" alt="" class="table-icon" />Player Name</a></td>
								<td>32</td>
								<td><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team Envyus</a></td>
							</tr>
							<tr>
								<td>HP</td>
								<td>Fringe</td>
								<td><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Player Name</a></td>
								<td>32</td>
								<td><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Faze Clan</a></td>
							</tr>
							<tr>
								<td>HP</td>
								<td>Stronghold</td>
								<td><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Player Name</a></td>
								<td>32</td>
								<td><a href="#"><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Team Kaliber</a></td>
							</tr>
							<tr>
								<td>HP</td>
								<td>Evac</td>
								<td><a href="#"><img src="images/teams/team-justus.png" alt="" class="table-icon" />Player Name</a></td>
								<td>32</td>
								<td><a href="#"><img src="images/teams/citadel-gaming.png" alt="" class="table-icon" />Citadel Gaming</a></td>
							</tr>
						</tbody>
					</table>	
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

