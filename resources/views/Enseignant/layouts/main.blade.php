<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
     <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <link rel="stylesheet" href="{{asset('css/style.css')}}">
     <link rel="stylesheet" href="{{asset('css/enseignant/global.css')}}">
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
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                       
                        <li><a href="{{route('account')}}">Account</a></li>
                        <li><a href="{{route('logout_user')}}">Log out</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
            </nav>
            <div class="container dashboard">
              <div class="row">
                 @yield('content')
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