@extends('layouts.main')
@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<style type="text/css">
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#eventForm .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<link rel="stylesheet" href="{{asset('css/cssSUBSCRIPTION.css')}}">
@endsection
@section('content')

@if(!$subscribed)
<div class="row">
    <div class="card" style="border-left:solid #23bab5 5px">
            <h4>
                Entrer le Code d'Abonnement 
                <input type="text" class="subscribe-number form-control" style="width:150px" id="codetext" required>
                <button id="bntVerification" class="btn btn-primary">Verifier</button>
              
            </h4>
            
    </div>
</div>
@endif
<div class="row">
    <div class="card">
        <h4><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
        Choissir votre methode de paiement
        </h4>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <h4>Virement Bancaire</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam quam nisi corporis optio, ex quos qui itaque fuga magni, nulla aliquam, odio nostrum atque? Nihil illum, esse et neque quae?
            </p>
            <div class="row compt-number">
                <div class="col-md-4">
                    <h5>Numerau De Compte</h5>
                </div>
                <div class="col-md-8">
                    <button class="btn form-controll">012345679879988</button>
                </div>
            </div>
           
        </div>
         <div class="card" style="border-left:solid 10px #23bab5">
                <div class="col-md-12 already">
                 <h4>Si vous avez déja payer  </h4>
                   <a id="lbl-verification">Cliquez ici</a> , pour qu'on puisse verifier votre paiement
                </div>
                <div class="clearfix"></div>
            </div>
        
    </div>
     <div class="col-md-6">
        <div class="card">
            <h4>Paypal</h4>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal">
                    <p>
                        PayPal est un service qui vous permet de payer en ligne, d'envoyer et de recevoir de l'argent sans partager vos informations bancaires.
                    </p>
                    <!-- Identify your business so that you can collect the payments. -->
                    <input type="hidden" name="business" value="herschelgomez@xyzzyu.com">

                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">

                    <!-- Specify details about the item that buyers will purchase. -->
                    <input type="hidden" name="item_name" value="Premium Umbrella">
                    <input type="hidden" name="amount" value="50.00">
                    <input type="hidden" name="currency_code" value="USD">


                    <!-- Display the payment button. -->
                    <input type="image" name="submit" border="0"
                        src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
                        alt="Buy Now">

                    <img alt="" border="0" width="1" height="1"
                    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

             </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
             <h4>Vous pouvez payer avec : </h4>
             <div class="col-md-3">
                <img src="{{asset('img/Rapport-de-Stage-wafacash.jpg')}}" class="img-responsive">
             </div>
             <div class="col-md-3">
                <img src="{{asset('img/cashplus.PNG')}}" class="img-responsive">
             </div>
             <div class="col-md-3">
                <img src="{{asset('img/Western-Union-logo-WU-1024x762.png')}}" class="img-responsive">
             </div>
           
             <div class="clearfix"></div>
             <h4 style="margin-top:20px">Les informations à communiquer</h4>
             <h4>Nom : Hamid MARCHICH</h4>
              <h4>Télephone : 06 27 40 48</h4>
            
        </div>
    </div>
    <div class="paiement-verification">
        <div class="alert alert-danger">
        
        </div>
        <i class="fa fa-times exit" aria-hidden="true" ></i>
        <h3>Verification de Paiment</h3>
        <form action="" id="request-verification">
           {{csrf_field()}}
            <div class="row form-group">
                <div class="col-md-4">
                   <label for="">Nom de Payeur</label> 
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name_payeur">
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-4">
                   <label for="">Date de paiement</label> 
                </div>
                <div class="col-md-6 date">
                    <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" name="date" />
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                   <label for="">Banque</label> 
                </div>
                <div class="col-md-6 ">
                   <select class="form-control" name="banque">
                        <option value="Attijari Wafa Bank">Attijari Wafa Bank</option>
                        <option value="Bmce Bank">Bmce Bank</option>
                        <option value="CIH">CIH</option>
                        <option value="">Autre</option>
                  </select>
                  <input id="AutreBanque" type="text" name="AutreBanque" style="margin-top:10px;display:none;" class="form-control" placeholder="Entrer le nom de la banque">
                   <button type="submit" class="btn btn-primary">Envoyer une demande de verification</button>
                </div>
            </div>

          
        </form>
    </div>

        <div class="success">
        <i class="fa fa-times exit" aria-hidden="true" ></i>
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        <h4>MLO FORMATION</h4>
        <h3>Votre Demande on été envoyer avec succès</h3>
    </div>
</div>


@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
        })

    $("#lbl-verification").click(function(){
        $(".paiement-verification").fadeIn();
    })
    $('.paiement-verification select').on('change', function() {
            if(this.value == "")
            {
                $("#AutreBanque").show();
            }
            else
            {
                $("#AutreBanque").hide();
            }
    })

    //Subscribe user
    $("#bntVerification").click(function(){
        if($("#codetext").val() =="")
        {
            alert("Vous Devez Saisir un chiffre de 12 characters");
        }
        else
        {
                $.ajax({
                url:"{{route('subscribe_user')}}",
                type:"POST",
                data:{code:$("#codetext").val(),_token:"{{csrf_token()}}"},
                success:function(data){
                    console.log(data.success)
                    if(data.success==true)
                    {
                        alert("Felicitation! vous etes maintenant abonnez");
                         window.location.href = "{{route('formation')}}";
                    }
                    else
                    {
                    alert(data.message);
                    
                    }
                },
                error:function()
                {
                 
                     alert("Une erreur s'est produit , contactez le developpeur pour resodre ce probleme")
                }
            })
        }
        
    })
   GetAjaxData("{{route('verfication_demande')}}", $("#request-verification") ,"POST",$(".paiement-verification"));
  //submit form
// $("#request-verification").submit(function(e)
// {
//     e.preventDefault();
//     $.ajax({
//         url:"{{route('verfication_demande')}}",
//         type:"post",
//         beforeSend:function()
//         {
//             $(".loading").show();
//         },
//         data:$(this).serialize(),
//         success:function(data)
//         {
//             ShowerrorOrSuccess(data,$(".paiement-verification"));
//         },
//         error:function()
//         {
//             alert("Something Wrong Please Contact Developer to Reseolve This problem");
//         }
//     })
// })
  
});

</script>
@endsection