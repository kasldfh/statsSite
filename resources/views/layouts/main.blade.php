<?php
    $events = App\Events::all();
    $teams = App\Team::all();
?>
<html>
	<head>
		<title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        @yield('style')

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="../../dist/js/vendor/html5shiv.js"></script>
          <script src="../../dist/js/vendor/respond.min.js"></script>
        <![endif]-->
        {!! HTML::style('assets/css/AdminLTE.min.css') !!}
    	{!! HTML::style('assets/css/custom.css') !!}
      {!! HTML::style('assets/val/css/formValidation.min.css') !!}
      {!! HTML::style('assets/file_input/css/fileinput.min.css')!!}
      {!! HTML::style('assets/datepicker/bootstrap-datetimepicker.min.css')!!}
	</head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#"><span class="logo"><img src="{!!asset('assets/img/logo.png')!!}" style="max-width:50px; margin-top: -12px;"></span><div class="logo" style="display:inline-block; vertical-align: middle;margin-top: -18px;">Stats</div></a>
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
                  </div><!-- /.container-fluid -->
                </nav>
        <div class="container">
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    @yield('content')
                </div>

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


