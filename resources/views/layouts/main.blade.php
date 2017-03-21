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
                    <i class="fa fa-bell-o notification" aria-hidden="true">
                        <p>8</p>
                    </i>
                    <li class="notification-card">
                        <a href="{{route('subscription')}}">
                            <h5 style=" border-left: solid #FF5252;padding-left: 5px"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color:red"></i>
                            Vous n'avez aucun subscription <br> <span>Abonnez Vous Pour benificier de tous les cours </span>
                            </h5>
                        </a>
                        @foreach($message_nameSender as $message)
                          <h5><i class="fa fa-commenting-o" aria-hidden="true" style="color:#F9A825"></i>Vous Avez un nouveaux Messages de {{$message->Sender_name}}
                              <br> <span>Sujet : {{str_limit($message->title, 30)}} </span>
                          </h5>
                        @endforeach
                        
                    </li>
                    <div class="dropdown" style="display: inline-block;">
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
                    <li><i class="fa fa-comment-o" aria-hidden="true"></i><a href="{{route('message')}}">Messages</a></li>
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
     <!--Loading -->
     <div class="loading">
        <img src="{{asset('img/ring (2).gif')}}" alt="">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        <h5>Chargement.....</h5>
        <h4>MLO FORMATION</h4>
    </div>
    
    <!--hide Back-->
    <div class="back-hide">
    </div>

    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <script src="{{asset('js/global.js')}}"></script>
   @yield('script')
</body>
</html>