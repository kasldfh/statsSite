<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Game Type Stats | COD World League NA Qualifier</title>
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
				<li class="active"><a href="event-game-type.php">Game Type</a></li>
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
<section class="section stats gray event" id="stats">
	<div class="wrap">

		<section id="game-types" class="section">
			<nav class="tabs">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#overall" aria-controls="overall" role="tab" data-toggle="tab">Overall</a></li>
					<li><a href="#snd" aria-controls="snd" role="tab" data-toggle="tab">SND</a></li>							
					<li><a href="#uplink" aria-controls="uplink" role="tab" data-toggle="tab">Uplink</a></li>
					<li><a href="#hardpoint" aria-controls="hardpoint" role="tab" data-toggle="tab">Hardpoint</a></li>
					<li><a href="#ctf" aria-controls="ctf" role="tab" data-toggle="tab">Capture the Flag</a></li>
				</ul>
			</nav>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="overall">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6">
							<table id="" class="data">
								<thead>
									<tr>
										<td>3-0's</td>
										<td>3-1's</td>
										<td>3-2's</td>
										<td>Total Games</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>16</td>
										<td>18</td>
										<td>13</td>
										<td>47</td>
									</tr>
									<tr>
										<td>34%</td>
										<td>38%</td>
										<td>28%</td>
										<td></td>
									</tr>									
								</tbody>
							</table>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<table id="" class="data">
								<thead>
									<tr>
										<td>Series W%</td>
										<td>1-0</td>
										<td>2-0</td>
										<td>1-2</td>
										<td>2-1</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td>80%</td>
										<td>89%</td>
										<td>18%</td>
										<td>82%</td>
									</tr>										
								</tbody>
							</table>
						</div>
					</div>
					<table id="" class="data">
						<thead>
							<tr>
								<td colspan="2" class="title">Clutch Stats</td>
								<td>Game 5 W</td>
								<td>Game 5 L</td>
								<td>Game 5 W(%)</td>
								<td>Game 11 W</td>
								<td>Game 11 L</td>
								<td>Game 11 W(%)</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="2" class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
								<td>4</td>
								<td>0</td>
								<td>100%</td>
								<td>3</td>
								<td>0</td>
								<td>100%</td>
							</tr>
							<tr>
								<td colspan="2" class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team Envyus</a></td>
								<td>2</td>
								<td>0</td>
								<td>100%</td>
								<td>2</td>
								<td>1</td>
								<td>66.667%</td>
							</tr>
							<tr>
								<td colspan="2" class="title"><a href="#"><img src="images/teams/optic-nation.png" alt="" class="table-icon" />Optic Nation</a></td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>1</td>
								<td>1</td>
								<td>50%</td>
							</tr>
							<tr>
								<td colspan="2" class="title"><a href="#"><img src="images/teams/epsilon-esports.png" alt="" class="table-icon" />Epsilon</a></td>
								<td>1</td>
								<td>2</td>
								<td>33.334%</td>
								<td>0</td>
								<td>1</td>
								<td>0%</td>
							</tr>
							<tr>
								<td colspan="2" class="title"><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe</a></td>
								<td>1</td>
								<td>1</td>
								<td>50%</td>
								<td>1</td>
								<td>1</td>
								<td>50%</td>
							</tr>
							<tr>
								<td colspan="2" class="title"><a href="#"><img src="images/teams/isolation.png" alt="" class="table-icon" />iSolation</a></td>
								<td>0</td>
								<td>3</td>
								<td>0%</td>
								<td>1</td>
								<td>0</td>
								<td>100%</td>
							</tr>
						</tbody>
					</table>	
					<table id="" class="data">
						<thead>
							<tr>
								<td class="title">Maps Played</td>
								<td>#</td>
								<td>%</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="title">Solar</td>
								<td>8</td>
								<td>4%</td>
								<td></td>
							</tr>	
							<tr>
								<td class="title">Retreat</td>
								<td>10</td>
								<td>5%</td>
								<td></td>
							</tr>	
							<tr>
								<td class="title">Detroit</td>
								<td>16</td>
								<td>9%</td>
								<td></td>
							</tr>	
							<tr>
								<td class="title">Bio Lab</td>
								<td>7</td>
								<td>4%</td>
								<td></td>
							</tr>									
						</tbody>
					</table>	
					<div class="row">
						<div class="col-xs-12 col-sm-5">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Outslay W%</td>
										<td>Win</td>
										<td>Loss</td>
										<td>Win %</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title">Uplink</td>
										<td>...</td>
										<td>...</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title">CTF</td>
										<td>...</td>
										<td>...</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title">HP</td>
										<td>...</td>
										<td>...</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title">Total</td>
										<td>98</td>
										<td>12</td>
										<td>89%</td>
									</tr>									
								</tbody>
							</table>
						</div>
						<div class="col-xs-12 col-sm-7">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">When Team Wins</td>
										<td>Uplink</td>
										<td>1st HP</td>
										<td>1st SND</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title">Series W%</td>
										<td>87%</td>
										<td>80%</td>
										<td>61%</td>
									</tr>									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12">							
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Average Outslayed By</td>
										<td>Overall</td>
										<td>HP</td>
										<td>Uplink</td>
										<td>SND</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href="#"><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>2.64</td>
										<td>2.00</td>
										<td>3.75</td>
										<td>0.70</td>
									</tr>	
									<tr>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
									</tr>									
									<tr>
										<td class="title"><a href="#"><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Nation</a></td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
									</tr>
									<tr>
										<td class="title"><a href="#"><img src="images/teams/epsilon-esports.png" alt="" class="table-icon" />Epsilon</a></td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
									</tr>
									<tr>
										<td class="title"><a href="#"><img src="images/teams/faze-clan.png" alt="" class="table-icon" />Team FaZe</a></td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
									</tr>
									<tr>
										<td class="title"><a href="#"><img src="images/teams/team-isolation.png" alt="" class="table-icon" />iSolation</a></td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
										<td>1.00</td>
									</tr>
								</tbody>
							</table>									
						</div>
					</div>							 
				</div>
				<div role="tabpanel" class="tab-pane" id="snd">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">1st Blood W%</td>
										<td>W%</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title">Breach</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Fringe</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Hunted</td>
										<td>...</td>
									</tr>	
									<tr>
										<td class="title">Evac</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Infection</td>
										<td>...</td>
									</tr>									
								</tbody>
							</table>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Plant %</td>
										<td>A</td>
										<td>B</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title">Breach</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Fringe</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Hunted</td>
										<td>...</td>
										<td>...</td>
									</tr>	
									<tr>
										<td class="title">Evac</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Infection</td>
										<td>...</td>
										<td>...</td>
									</tr>									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Plant W%</td>
										<td>A</td>
										<td>B</td>
										<td>Total</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title">Breach</td>
										<td>...</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Fringe</td>
										<td>...</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Hunted</td>
										<td>...</td>
										<td>...</td>
										<td>...</td>
									</tr>	
									<tr>
										<td class="title">Evac</td>
										<td>...</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Infection</td>
										<td>...</td>
										<td>...</td>
										<td>...</td>
									</tr>									
								</tbody>
							</table>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Offense/Defense W%</td>
										<td>Offense</td>
										<td>Defense</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title">Breach</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Fringe</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Hunted</td>
										<td>...</td>
										<td>...</td>
									</tr>	
									<tr>
										<td class="title">Evac</td>
										<td>...</td>
										<td>...</td>
									</tr>
									<tr>
										<td class="title">Infection</td>
										<td>...</td>
										<td>...</td>
									</tr>									
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title"></td>
										<td>Offense</td>
										<td>Defense</td>
										<td>FB W%</td>
										<td>Plant W%</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>54%</td>
										<td>46%</td>
										<td>73%</td>
										<td>72%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
										<td>54%</td>
										<td>46%</td>
										<td>73%</td>
										<td>72%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
										<td>54%</td>
										<td>46%</td>
										<td>73%</td>
										<td>72%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>54%</td>
										<td>46%</td>
										<td>73%</td>
										<td>72%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
										<td>54%</td>
										<td>46%</td>
										<td>73%</td>
										<td>72%</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="uplink">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title"></td>
										<td>W%</td>
										<td>Carries/game</td>
										<td>Throws/game</td>
										<td>Uplinks/game</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>54%</td>
										<td>10.2</td>
										<td>13.9</td>
										<td>9.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
										<td>54%</td>
										<td>10.2</td>
										<td>13.9</td>
										<td>9.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
										<td>54%</td>
										<td>10.2</td>
										<td>13.9</td>
										<td>9.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>54%</td>
										<td>10.2</td>
										<td>13.9</td>
										<td>9.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
										<td>54%</td>
										<td>10.2</td>
										<td>13.9</td>
										<td>9.5</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="hardpoint">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">General Stats</td>
										<td>K/D</td>
										<td>W</td>
										<td>L</td>
										<td>W%</td>
										<td>Engagements/game</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
										<td>42.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
										<td>42.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
										<td>42.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
										<td>42.5</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
										<td>42.5</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Outslay %</td>
										<td>Overall</td>
										<td>Breach</td>
										<td>Fringe</td>
										<td>Hunted</td>
										<td>Evac</td>
										<td>Infection</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="ctf">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">General Stats</td>
										<td>K/D</td>
										<td>W</td>
										<td>L</td>
										<td>W%</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
										<td>1.2</td>
										<td>5</td>
										<td>0</td>
										<td>100%</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<table id="" class="data">
								<thead>
									<tr>
										<td class="title">Outslay %</td>
										<td>Overall</td>
										<td>Breach</td>
										<td>Fringe</td>
										<td>Hunted</td>
										<td>Evac</td>
										<td>Infection</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="title"><a href=""><img src="images/teams/optic-gaming.png" alt="" class="table-icon" />Optic Gaming</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/denial-esports.png" alt="" class="table-icon" />Denial Esports</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-elevate.png" alt="" class="table-icon" />Team eLevate</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/team-envyus.png" alt="" class="table-icon" />Team EnvyUs</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>
									<tr>
										<td class="title"><a href=""><img src="images/teams/faze-clan.png" alt="" class="table-icon" />FaZe Clan</a></td>
										<td>74.2%</td>
										<td>75%</td>
										<td>63.2%</td>
										<td>81.6%</td>
										<td>73.65%</td>
										<td>91.1%</td>
									</tr>								
								</tbody>
							</table>
						</div>
					</div>
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

