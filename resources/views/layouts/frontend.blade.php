<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Call of Duty Esports Statistics</title>
  <meta name="description" content="">
  @include('frontend.assets.head-links')
  @yield('scripts')
</head>
<body>

<!-- BANNER
================================================== -->
<div id="banner" style="background-image:url(images/banners/about.jpg);" data-type="background" data-speed="6">

    <!-- NAVIGATION
    ================================================== -->
    <header id="top-header">
      <div class="wrap">
        <a href="index.php" class="logo">
          <img src="/images/logo.png" alt="COD Stats Logo" />
        </a>
        <nav id="main-nav">
          <ul class="nav">
            <li><a href="/">Events</a></li>
            <li><a href="/teams">Teams</a></li>
            {{--<li><a href="leaderboards.php">Leaderboards</a></li>--}}
            <li><a href="/about">About</a></li>
          </ul>
        </nav>
        <button type="button" class="nav-toggle">
          <span class="menu-text"><i class="fa fa-bars"></i> Menu</span>
        </button>
      </div>
    </header><!-- /navigation -->

  <div class="banner-content event">
    @yield('banner')
{{--<h1><img src="images/teams/optic-gaming.png" alt="" class="team-icon" />Optic Gaming</h1>--}}
  </div>
</div><!-- /banner -->

<!-- CONTENT
================================================== -->
@yield('content')

<!-- FOOTER
================================================== -->
<footer id="main-footer">

  <div class="container">

    <div class="row">
      <div class="col-xs-12 col-md-8">
        <ul class="">
          <li><a href="/">Home</a></li>
          <li><a href="/">Events</a></li>
          <li><a href="/teams">Teams</a></li>
          {{--<li><a href="leaderboards.php">Leaderboards</a></li>--}}
          <li><a href="/about">About</a></li>
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
  @yield('loadlast')
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
</body>
</html>

