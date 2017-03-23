@extends('layouts.main')
@section('style')

    <link rel="stylesheet" href="{{asset('css/styleACCOUNT.css')}}">

@endsection
@section('content')


<!--Get User Data-->


<div class="row">
<div class="col-md-12">
    <div class="card">
         <h4>Account Information</h4>
    </div>
</div>
</div>

<div class="row">
    <div class="card col-md-8">
        <h4>General Information</h4>
        <form action="{{route('changeINFO')}}" method="post" id="formGenralInfo">
            {{csrf_field()}}
                <div class="row form-group">
                    <div class="col-md-4">Nom : </div>
                    <div class="col-md-8">
                    <input type="text" class="form-control" disabled value="{{$name}}">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">Subsciption : </div>
                    <div class="col-md-8">
                    @if($subscribed)
                       <input type="text" class="form-control" disabled value="Oui">
                    @else
                       <input type="text" class="form-control" disabled value="Non">
                    @endif
                   
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">Date de creation : </div>
                    <div class="col-md-8">
                    <input type="text" class="form-control" disabled value="{{$date_creation}}">
                    </div>
                </div>
                                <div class="row form-group">
                    <div class="col-md-4">Email : </div>
                    <div class="col-md-8">
                    <input type="text" id="emailINPUT" class="form-control"  name="email" value="{{$email}}" disabled required>
                    <a id="resetemail" style="font-size:12px">Changer votre email</a>
                    <a class="cancel" id="cancelEMAIL">Annuler la modification</a>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4">Téléphone : </div>
                    <div class="col-md-8">
                    <input id="telINPUT" type="text" class="form-control" name="telephone" value="{{$telephone}}" disabled required>
                     <a id="resetTEL" style="font-size:12px">Changer votre numerau du téléphone</a>
                    <a class="cancel" id="cancelTEL">Annuler la modification</a>                     
                    </div>
                </div>
                <div class="row form-group">
                        <div class="col-md-4">Mot de passe : </div>
                        <div class="col-md-8">
                        <input id="passwordInput" type="password" class="form-control" disabled value="#######" name="password" required>
                        <a id="resetmdp" style="font-size:12px">Changer votre mot de passe</a>
                        <a class="cancel" id="cancelMDP">Annuler la modification</a>                        
                    </div>
                </div>
                 <button type="submit" class="btn btn-success pull-right">Enregistrer</button>
         </form>
     </div>
     <div class="col-md-4">
         <div class="card subscription">
            <h4>Subscription</h4>
            @if(!$subscribed)
            <p>
               Vous n'avez aucun abonnement
            </p>
            <button class="btn btn-success">Abonnez vous</button>
            @else
            <h5>Date d'Abonnement : <span style="color:#23bab5">{{$date_subscription}}</span></h5>
            <h5>Date fin d'Abonnement : <span style="color:#FF5252">{{$date_fin_subscription}}</span></h5>
            @endif
         </div>       
     </div>    

    
</div>
<div class="success">
     <i class="fa fa-times exit" aria-hidden="true" ></i>
     <i class="fa fa-graduation-cap" aria-hidden="true"></i>
     <h4>MLO FORMATION</h4>
    <h3>Votre nouveau information on été enregistré avec succès</h3>
</div>
@endsection

@section('script')

<script>

    function  GenralInformationField() {
                $("#resetmdp").click(function(){
                    $("#passwordInput").attr('disabled',false)
                    $("#passwordInput").attr("value","");
                    $("#passwordInput").attr("placeholder","Entrer votre nouveau mot de passe");
                    $("#resetmdp").hide();
                    $("#cancelMDP").show();
                })
                $("#resetemail").click(function(){
                    $("#emailINPUT").attr("disabled",false);
                    $("#resetemail").hide();
                    $("#cancelEMAIL").show();
                })
                
                $("#resetTEL").click(function(){
                    $("#telINPUT").attr("disabled",false);
                    $("#resetTEL").hide();
                    $("#cancelTEL").show();
                })

                $("#cancelEMAIL").click(function(){
                
                    $("#emailINPUT").attr('disabled',true);
                    $("#resetemail").show();
                    $(this).hide();
                })
                $("#cancelTEL").click(function(){
                
                    $("#telINPUT").attr('disabled',true);
                    $("#resetTEL").show();
                    $(this).hide();
                })
                $("#cancelMDP").click(function(){
                
                    $("#passwordInput").attr('disabled',true);
                    $("#passwordInput").attr('value',"######");
                    $("#resetmdp").show();
                    $(this).hide();
                })
    }


    //AJAX form
     $("#formGenralInfo").submit(function(e){
         e.preventDefault();
         $.ajax({
             url : "{{route('changeINFO')}}",
             type:'POST',
             beforeSend:function(){
                $(".loading").fadeIn();
             },
             data : $(this).serialize(),
             success:function(data){
                 $(".loading").fadeOut();
                 if(data.success==true)
                 {
                    $(".success").fadeIn();
                    $("#cancelEMAIL").click();
                     $("#cancelTEL").click();
                      $("#cancelMDP").click();
                 }
                 else
                 {
                   alert(data.error);
                 }
             },
             error:function(){
                 alert("Something Wrong Please Contact Developer");
                 $(".loading").fadeOut();
             }
         })
     })
   
</script>
<script>
    $(document).ready(function(){
        GenralInformationField();

    })
</script>
@endsection