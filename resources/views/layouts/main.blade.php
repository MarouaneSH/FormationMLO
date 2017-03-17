<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
     <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <link rel="stylesheet" href="{{asset('css/style.css')}}">
     <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('css/font-awesome/css/font-awesome.min.css')}}">
     @yield('style')
</head>
<body>

          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="{{route('formation')}}"><i class="fa fa-graduation-cap" aria-hidden="true"></i>MLO FORMATION</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i>{{ Auth::user()->name }}
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                       
                        <li><a href="{{route('account')}}">Account</a></li>
                        <li><a href="{{route('logout_user')}}">Log out</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
            </nav>
            <div id="menu-left">
                <ul id="menu">
                    <li class="menu-header">APPLICATION</li>
                    <li><i class="fa fa-tasks" aria-hidden="true"></i> <a href="{{route('formation')}}">Dashboard</a></li>
                    <li><i class="fa fa-info-circle" aria-hidden="true"></i>A propos</li>
                    <li class="menu-header">ACCOUNT</li>
                    <li><i class="fa fa-id-card" aria-hidden="true"></i> <a href="{{route('account')}}">General</a></li>
                    <li><i class="fa fa-credit-card-alt" aria-hidden="true"></i><a href="{{route('subscription')}}">Subscriptions</a> </li>
                    <li class="menu-header">COURS</li>
                    <li><i class="fa fa-leanpub" aria-hidden="true"></i>Voir Les Cours</li>
                    <li><i class="fa fa-comment-o" aria-hidden="true"></i>Messages</li>
                </ul>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
            </div>
            
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <script src="{{asset('js/global.js')}}"></script>
   @yield('script')
</body>
</html>