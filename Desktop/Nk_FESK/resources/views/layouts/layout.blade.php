<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>@yield('title')</title>

        <!-- Bootstrap - Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
		<div style="text-align:center;">
			<img src="{{url('/images/fesk_naslovna.jpg')}}" alt="Image"/>
		</div>
        <nav class="navbar navbar-default" style="background-color:#00e5ff;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home')}}">NK Fešk</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
						@unless(Sentinel::check())
                            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}">Početna</a></li>
							<li class="{{ Request::is('teams') ? 'active' : '' }} " >
								<a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Selekcije</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									@foreach($teams as $team)
										<a class="dropdown-item" href="{{ route('team', urlencode($team->id)) }}">{{$team->naziv}}</a><br>
									@endforeach
									</div>
							</li>
							<li class="{{ Request::is('documents') ? 'active' : '' }}"><a href="{{ route('documents') }}">Dokumenti</a></li>
							<li class="{{ Request::is('articles') ? 'active' : '' }}"><a href="{{ route('articles') }}">Članci</a></li>
							<li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Kontakt</a></li>
						@endunless	
                        @if (Sentinel::check() && Sentinel::inRole('administrator'))
                                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="{{ Request::is('admin/users*') ? 'active' : '' }}"><a href="{{ route('users.index') }}">Users</a></li>
                                <li class="{{ Request::is('admin/roles*') ? 'active' : '' }}"><a href="{{ route('roles.index') }}">Roles</a></li>
								<li class="{{ Request::is('admin/teams*') ? 'active' : '' }}"><a href="{{ route('teams.index') }}">Teams</a></li>
								<li class="{{ Request::is('admin/players*') ? 'active' : '' }}"><a href="{{ route('players.index') }}">Players</a></li>
								<li class="{{ Request::is('admin/documents*') ? 'active' : '' }}"><a href="{{ route('documents.index') }}">Documents</a></li>
								<li class="{{ Request::is('admin/articles*') ? 'active' : '' }}"><a href="{{ route('articles.index') }}">Articles</a></li>
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (Sentinel::check())
                            <li>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="user"></span> {{ Sentinel::getUser()->email }} <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                <li><a href="{{ route('auth.logout') }}">Log Out</a></li>
                              </ul>
                            </li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            @include('notifications')
            @yield('content')
        </div>
		
		<div>
		@include('footer')
		</div>

		
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
        <script src="{{ asset('js/restfulizer.js') }}"></script>
    </body>
</html>
