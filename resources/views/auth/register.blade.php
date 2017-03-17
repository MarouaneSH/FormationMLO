@extends('layouts.app')

@section('content')

<div class="container">
    <div class="login-signup">
      <div class="row">
        <div class="col-sm-6 nav-tab-holder">
        <ul class="nav nav-tabs row" role="tablist">
          <li role="presentation" class="active col-sm-6"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Creer un Compte</a></li>
        </ul>
      </div>

      </div>

      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <div class="row">

            <div class="col-sm-6 mobile-pull">
              <article role="login">
                <h3 class="text-center"><i class="fa fa-lock"></i>Creer un Compte</h3>
                        @if(count($errors->all())>0)
                         <div class="aler alert-danger">
                                @foreach ($errors->all() as $error)                             
                                       <li>{{ $error }} </li>                          
                                @endforeach
                           </div>
                        @endif
                  
                    <form class="signup" action="{{ route('register') }}" method="post">
                                  {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Vote Nom" name="name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Numerau de téléphonbe" name="tel">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Ville" name="ville">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Confirmer votre mot de passe" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block"  value="Creer votre Compte">
                            </div>
                    </form>
              </article>
            </div>

            <div class="col-sm-6">
              <article role="manufacturer"  class="text-center">
                <header>
                  Formation Online Professionnel
                </header>
                <h1>Des cours en ligne gratuits</h1>
                <ul class="text-left">
                  <li><i class="fa fa-check"></i>  Plus de 100 cours disponnible</li>
                  <li><i class="fa fa-check"></i>  Support 24/7h</li>
                  <li><i class="fa fa-check"></i>  Des Formation en direct</li>
                  <li><i class="fa fa-check"></i>  Share Files</li>
                  <li><i class="fa fa-check"></i>   Unlimited  access</li>
                  <li><i class="fa fa-check"></i>  Unlimited  access</li>
                </ul>
                Vous Avez Déja un Compte ? <br>
                <a href="#" class="btn btn-success">Login</a>
              </article>
            </div>

          </div>
          <!-- end of row -->
        </div>
        <!-- end of home -->
@endsection
