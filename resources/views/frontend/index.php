<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Competitive Call of Duty Esports Statistics</title>
	<meta name="description" content="">
	
	<?php include("assets/head-links.php"); ?>

</head>
<body>

<!-- BANNER
================================================== -->
<div id="banner" class="home" style="background-image:url(images/banners/about.jpg);" data-type="background" data-speed="6">
	
	<?php include("assets/header.php"); ?>
	
	<div class="wrap">
		<div class="banner-content">
			<div class="latest-blocks">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6">
						<a href="event.php" class="block">
							<div class="block-bg" style="background-image:url(images/events/totinos-invitational-2015-home.jpg);"></div>
							<div class="block-content">
								<span class="detail-box">Latest Event</span>
								<h1>Black Ops 3 <br/>Tostino's Invitational</h1>
							</div>
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="event.php"  class="block">
							<div class="block-bg" style="background-image:url(images/events/mlg-world-finals-2015-home.jpg);"></div>
							<div class="block-content">
								<h3>MLG World Finals 2015</h3>
							</div>
						</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="event.php"  class="block">
							<div class="block-bg" style="background-image:url(images/events/mlg-pro-league-season-3-playoffs-home.jpg);"></div>
							<div class="block-content">
								<h3>MLG Season 3 Playoffs</h3>
							</div>
						</a>
					</div>
				</div>
			</div>

			<a href="events.php" class="btn trans">View All Events</a>

		</div>

	</div>

</div><!-- /banner -->

<!-- LEADERBOARDS
================================================== -->
<section class="section lg">

	<div class="wrap">

		<div class="row">
			<div class="col-xs-12 col-sm-5 col-md-5 section-col">
				<h2>Leaderboards</h2>
				<p class="lg">See which players rank the highest in categories such as Overall K/D, Total Kills, Uplink Captures, and many others!</p>
				<a href="" class="btn blue">View All Leaderboards</a>
			</div>
			<div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-1 section-col leaderboard-preview">
				<h4 class="pull-left">Popular Leaderboards</h4>
				<table class="data">
					<thead>
						<tr>
							<td colspan="2" class="title">Slayer Leaderboard</td>
							<td>K/D</td>
							<td>Maps</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Scump</a></td>
							<td>1.35</td>
							<td>35</td>
						</tr>
						<tr>
							<td>2</td>
							<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Crimsixian</a></td>
							<td>1.29</td>
							<td>35</td>
						</tr>
						<tr>
							<td>3</td>
							<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Censor</a></td>
							<td>1.28</td>
							<td>32</td>
						</tr>
						<tr>
							<td>4</td>
							<td class="title"><a href=""><img src="images/teams/team-kaliber.png" alt="" class="table-icon" />Goonjar</a></td>
							<td>1.23</td>
							<td>39</td>
						</tr>
						<tr>
							<td>5</td>
							<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />nV Hastr0</a></td>
							<td>1.20</td>
							<td>32</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>

</section><!-- /leaderboards -->

<!-- TWITTER
================================================== -->
<section class="section lg gray">

	<div class="wrap">

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 section-col">
				<h2>Get the Latest Updates</h2>
				<p>Follow us on Twitter <a href="https://twitter.com/CoD_Stats" class="text-link">@CoD_Stats</a> if you don't fancy looking through the tables of data and want to see the most interesting stats in a simpler form. You can also see the widget below to see the kind of things we tweet!</p>
				<a href="https://twitter.com/CoD_Stats" class="btn blue"><i class="fa fa-twitter"></i>Follow Us on Twitter</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 section-col twitter-feed">
				<a class="twitter-timeline"  href="https://twitter.com/CoD_Stats"  data-widget-id="496299287655890946">Tweets by @CoD_Stats</a>
			</div>
		</div>

	</div>

</section><!-- /twitter -->

<?php include("assets/footer.php"); ?>

<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script>
</body>
</html>

