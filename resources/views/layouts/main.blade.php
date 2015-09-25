<html>
	<head>
		<title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        @yield('style')

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="../../dist/js/vendor/html5shiv.js"></script>
          <script src="../../dist/js/vendor/respond.min.js"></script>
        <![endif]-->
        {!! HTML::style('assets/css/bootstrap.css') !!}
        {!! HTML::style('assets/css/app.css') !!}
        {!! HTML::style('assets/css/animate.css') !!}
        {!! HTML::style('assets/css/font.css') !!}
    	{!! HTML::style('assets/css/custom.css') !!}
      {!! HTML::style('assets/val/css/formValidation.min.css') !!}
      {!! HTML::style('assets/file_input/css/fileinput.min.css')!!}
      {!! HTML::style('assets/datepicker/bootstrap-datetimepicker.min.css')!!}
	</head>
    <body class="">
    <section class="vbox">
        <header class="bg-light header header-md navbar navbar-fixed-top-xs box-shadow">

                          <div class="navbar-header bg-primary aside-md dk">
                              <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                                  <i class="fa fa-bars"></i>
                              </a>
                              <a href="#" class="navbar-brand">
                                  <i class="fa fa-bar-chart-o icon m-r-sm">
                                  </i><span class="hidden-nav-xs">CoDStats</span>
                              </a>
                              <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
                                  <i class="fa fa-cog"></i>
                              </a>
                          </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="collapse">
                        <ul class="nav navbar-nav">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Events <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            @foreach($events as $event)
                            <li>{!!link_to_action('LeaderboardController@viewByEvent', $event->name, ['id' => $event->id], [])!!}</li>
                            @endforeach
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Teams <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            @foreach($teams as $team)
                            <li><a href="#">{!!$team->name!!}</a></li>
                            @endforeach
                          </ul>
                        </li>
                        @yield('admin')
                        </ul>
                    </div><!-- /.navbar-collapse -->

        </header>
        <section class="hbox stretch">
        <aside class="bg-light aside-md hidden-print hidden-xs" id="nav">
            <section class="vbox">
                <section class="w-f scrollable">
                    <div class=" " data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                        <div class="clearfix wrapper dk nav-user hidden-xs">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">
                        <img src="{!!asset('assets/img/headshots/3.png')!!}" class="dker" alt="...">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">zpoon</strong>
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block">Admin</span>
                      </span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li>
                                        <span class="arrow top hidden-nav-xs"></span>
                                        <a href="#">Settings</a>
                                    </li>
                                    <li>
                                        <a href="profile.html">Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge bg-danger pull-right">3</span>
                                            Notifications
                                        </a>
                                    </li>
                                    <li>
                                        <a href="docs.html">Help</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="modal.lockme.html" data-toggle="ajaxModal" >Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <!-- nav -->
                        <nav class="nav-primary hidden-xs">

                            <ul class="nav nav-main" data-ride="collapse">

                                <li>
                                    <a href="#">                        <i class="fa fa-home icon">
                                        </i>
                                        <span class="font-bold">Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">                        <i class="fa fa-trophy icon">
                                        </i>
                                        <span class="font-bold">Leaderboards</span>
                                    </a>
                                </li>
                            </ul>

                        </nav></div>
                    </div>
                </section>

                <footer class="footer hidden-xs no-padder text-center-nav-xs">
                    <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                        <i class="fa fa-logout"></i>
                    </a>
                    <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                        <i class="fa fa-arrow-circle-left text"></i>
                        <i class="fa fa-arrow-circle-right text-active"></i>
                    </a>
                </footer>
            </section>
        </aside>
        <div class="content">
            <section class="vbox">
            <section class="scrollable padder">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    @yield('content')
                </div>
                </section>
                </section>

            </div>
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="footer-container">
                    <hr>
                    <footer><center> © Cod_Stats 2014 - 2015 </center></footer>
                </div>
                </div>
            </div>
        </div>
    </section>
    </section>

        {!! HTML::script('assets/datepicker/jquery-2.1.3.min.js')!!}
        {!! HTML::script('//code.jquery.com/ui/1.11.4/jquery-ui.js')!!}
        {!! HTML::script('assets/datepicker/bootstrap.min.js') !!}
        {!! HTML::script('assets/val/js/formValidation.min.js') !!}
        {!! HTML::script('assets/val/js/framework/bootstrap.min.js') !!}
        {!! HTML::script('assets/file_input/js/fileinput.min.js')!!}
        {!! HTML::script('assets/datepicker/moment.min.js')!!}
        {!! HTML::script('assets/datepicker/bootstrap-datetimepicker.min.js')!!}
        {!! HTML::script('assets/js/custom.js') !!}
        {!! HTML::script('assets/js/Chart.min.js') !!}
        {!! HTML::script('assets/js/app.min.js') !!}
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.min.js"></script>
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.js"></script>
        <script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        @yield('js')
    </body>

</html>


