<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>covid-19 case manager</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="your-project-dir/font-css/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
    <link rel="stylesheet" href="assests/chart.js/Chart.css">
 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body class="w3-teal"  style="background-color:teal color:black;" >
    <div id="app">
      <div style="background-color:black">
        <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <H1 style="color:white">COVID-19 CASE MANAGER</H1 > 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color:white">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color:white">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @if(Auth::user()->role === 'Director')
                                <li class="nav-item dropdown">
    
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:white">
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endif
                                 @if (Auth::user()->role === 'Administrator')
                                 <li class="nav-item dropdown">
                                     
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                    style="color:white" >{{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
    
                                    </div>
                                </li>
                                 @endif
                                
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </div> 
<div class="w3-sidebar w3-bar-block w3-light-blue w3-card" style="width:15%">
<a href="home" class="w3-bar-item w3-button"><i class="fa fa-home"></i>  Home</a>
  @if(Auth::user()->role === 'Administrator')
  <a href="registerhealthofficer" class="w3-bar-item w3-button"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>&nbsp;  Register Health Officers</a> 
  <a href="funds" class="w3-bar-item w3-button"><i class="fa fa-user"></i>  Register Donor Funds</a>
  @endif
  <a href="Covid_19_lists" class="w3-bar-item w3-button"><i class="fa fa-address-book fa-fw" aria-hidden="true"></i>&nbsp; Enrolled Patients Lists</a>
  <div class="w3-dropdown-hover">
    <button class="w3-button"><i class="fas fa-briefcase-medical"></i>  Hospitals
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="w3-dropdown-content w3-bar-block">
      <a href="hospital" class="w3-bar-item w3-button">General</a>
      <a href="regional_hospital" class="w3-bar-item w3-button">Regional</a>
      <a href="national_hospital" class="w3-bar-item w3-button">Regional</a>
    </div>
  </div> 

  <div class="w3-dropdown-hover">
    <button class="w3-button"><i class="fa fa-user"></i>  Officers Lists
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="w3-dropdown-content w3-bar-block">
      <a href="healthofficerlists" class="w3-bar-item w3-button">Officers General</a>
      <a href="officersRegional" class="w3-bar-item w3-button">oficers Regional</a>
      <a href="officersNational" class="w3-bar-item w3-button">officers National</a>
      <a href="pending_list" class="w3-bar-item w3-button">Pending officers</a>
    </div>
  </div>
  <a href="payments" class="w3-bar-item w3-button"><i class="fa fa-dollor"></i>  View Payments</a> 
  <a href="hierarchy-charts" class="w3-bar-item w3-button"><i class="fa fa-graph"></i>  Hierarchy Chart</a>
  <a href="graphs" class="w3-bar-item w3-button"><i class="fa fa-line-chart" aria-hidden="true"></i>  Graphs</a>
</div>

<div style="margin-left:17%">

    <div class="w3-container">
        <div class="content">

            @yield('content')

        </div>
    </div>

</div>


</div>
</html>
