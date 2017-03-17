@extends('layouts.app')

@section('content')
<div class="container">
        <div class="info">
            <h3>MLO-CONSULTING</h3><span>Formation En ligne</span>
        </div>
        </div>
        <div class="form">
        <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
        <form class="login-form"  method="POST" action="{{route('login')}}">
            @if(count($errors->all())>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
                {{csrf_field()}}
            <input type="text" placeholder="Email Adresse" name="email" />
            <input type="password" placeholder="password" name="password" />
            <button>login</button>
            <p class="message">Vous étes pas inscrit ?  <a href="{{route('register')}}">Inscrire maintenant</a></p>
        </form>
        </div>

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

      

</body>
        
    
@endsection
