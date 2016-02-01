<!-- FOOTER
================================================== -->
<footer id="main-footer">

	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-md-8">
				<ul class="">
					<li><a href="index.php">Home</a></li>
					<li><a href="events.php`">Events</a></li>
					<li><a href="teams.php">Teams</a></li>
					<li><a href="leaderboards.php">Leaderboards</a></li>
					<li><a href="about.php">About</a></li>
				</ul>
				<p>Copyright &copy; 2015 Competitive COD Stats</p>
			</div>
			<div class="col-xs-12 col-md-4">
				<a href="https://twitter.com/CoD_Stats" class="twitter"><i class="fa fa-twitter"></i>Follow @CoD_Stats</a>
			</div>
		</div>

	</div>

</footer><!-- /footer -->

	<!-- JavaScript
	================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="/frontend_assets/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){

			var $window = $(window); //You forgot this line in the above example
/*
			$('[data-type="background"]').each(function(){
				var $bgobj = $(this); // assigning the object
				$(window).scroll(function() {
					var yPos = -($window.scrollTop() / $bgobj.data('speed'));
					// Put together our final background position
					var coords = '50% '+ yPos + 'px';
					// Move the background
					$bgobj.css({ backgroundPosition: coords });
				});
			});
*/
			$('.nav-toggle').click(function() {
				/* ACTIVATE NAV SLIDEOUT */
				$('nav#main-nav').toggleClass('active');
				/* ACTIVATE BODY SLIDEOUT */
				$('body').toggleClass('slide-active');
			})
		});
	</script>
