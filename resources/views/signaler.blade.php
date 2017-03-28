@extends('layouts.main')
@section('style')
<link rel="stylesheet" href="{{asset('css/MessageCss.css')}}">
@endsection

@section('content')

<div class="card">
    <h4>Signaler un probleme</h4>
    <form action="{{route('signalerPost')}}" method="POST" style="margin-top:60px" id="form"  enctype="multipart/form-data">
        {{csrf_field()}}
        @if(count($errors)>0)
            <div class="alert alert-danger" style="display:block">
                    <li>Vous devez Saisir un message</li>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success" style="display:block">
                    <li>Votre message a été envoyer avec success</li>
            </div>
        @endif
        <div class=" row form-group">
            <div class="col-md-3">
                  Ecrivez votre probleme
            </div>
            <div class="col-md-6">
                     
                  <textarea name="msg" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="row form-group">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6">
                    <input type="file" name="file">
                    <button class="btn btn-primary" type="submit" style="margin-top:20px">Envoyer</button>
                </div>
        </div>
    </form>
</div>



@endsection

@section('script')
<script>
    // $("#form").submit(function(e){
    //     $(".alert").html("");
    //     e.preventDefault();
    //     $.ajax({
            
    //         url:"{{route('signalerPost')}}",
    //         type:"POST",
    //         beforeSend:function(){
    //             $(".loading").show();
    //         },
    //         data:$(this).serialize(),
    //         success:function(data){
               
    //             $(".loading").hide();
    //             if(data.success==false)
    //             {
    //                  $(".alert").show();
                   
    //                 $.each(data.errors,function(i,error){
    //                     $(".alert").append("<li>"+error+"</li>");
    //                 })
    //             }
    //             else
    //             {
    //                 $(".alert").hide();
    //                 alert("Success")
    //             }
    //         },
    //         error:function()
    //         {
    //             alert("Something Wrong Please Contact developer to resolve this problem")
    //         }
            
    //     })
    // })
</script>

@endsection