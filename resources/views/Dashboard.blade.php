@extends('layouts.main')
@section('style')
<link rel="stylesheet" href="{{asset('css/styleFormation.css')}}">
@endsection
@section('content')

<!--Check if User Susbcription has ENDED-->
@if(!empty($subscribtion_finished))
        <div class="back-hide" style="display:block">
        </div>
        <div id="subscription_ened">
            <i class="fa fa-times exit" aria-hidden="true" style="color:white" ></i>
            <h3><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Votre Abonnement a été fini 
            <br>        <p>Commencer une nouvelle abonnement , en cliquant <a href="{{route('subscription')}}" style="color:#fffa10">ICI</a> . </p>
            </h3>
        </div>
@endif
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
            <li class="list-group-item item">Formation 3 </li>
            <li class="list-group-item item">Formation 4</li>
            <li class="list-group-item item">Formation 5 </li>

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
                  <h5 class="item">Il vous reste {{$jours_restant }} jours</h5>
                  <h5 class="">Date Fin d'abonnement : {{$date_fin_subscription}}</h5>
              @else
                   <h5 class="item">Vous n'avez aucun subscription</h5>
              @endif
        </div>
        <div class="card">
          <h4><i class="fa fa-comment-o" aria-hidden="true"></i> Message</h4>
            @if($message_unread != 0 )
               <h5 class="item">Vous avez {{$message_unread}} nouveaux message .</h5>
            @else
               <h5 class="item">Vous n'avez aucun nouveau messages .</h5>
            @endif
           
        </div>
   </div>
</div>

@endsection