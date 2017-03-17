@extends('layouts.main')
@section('style')
<link rel="stylesheet" href="{{asset('css/styleFormation.css')}}">
@endsection
@section('content')

<!--Check if User are subscribed-->
<?php 
 
 if(!Auth::user()->subscribed)
 {
     $subscribed = false;
 }
 else
 {
     $subscribed = true;
 }
 ?>


@if(!$subscribed )
    <div class="row">
        <div class="card subscription">
            <h5 class="pull-left">
                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                Votre avez un compte grauit veuillez mettre a jour votre compte pur beneficier de tous les cours .
            </h5>
            <button class="btn btn-success pull-right">Upgrade</button>
            <div class="clearfix"></div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-7">
        <ul class="list-group">
            <li class="list-group-item"><i class="fa fa-leanpub" aria-hidden="true"></i> Cours Récent <span><a href="#">Tous Les Cours</a></span></li>
            <li class="list-group-item item">Formation 1 </li>
            <li class="list-group-item item">Formation 2</li>
        </ul>
        <div class="card @if(!$subscribed) disabled @endif">
        <h4><i class="fa fa-book" aria-hidden="true"></i> Test Final</h4>
         <h5 class="item">Vous etes pret ?   Commancer le Test</h5>
    </div>
    </div>
    <div class="col-md-4 ">
        <div class="card ">
              <h4><i class="fa fa-clock-o" aria-hidden="true"></i> Temps Restant</h4>
              @if($subscribed) 
                  <h5 class="item">Il vous reste 27 jours</h5>
              @else
                   <h5 class="item">Vous n'avez aucun subscription</h5>
              @endif
        </div>
        <div class="card">
          <h4><i class="fa fa-comment-o" aria-hidden="true"></i> Message</h4>
           <h5 class="item">Vous avez 2 nouveaux message .</h5>
        </div>
   </div>
</div>

@endsection