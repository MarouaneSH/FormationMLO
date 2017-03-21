@extends('layouts.main')
@section('style')
<link rel="stylesheet" href="{{asset('css/MessageCss.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-5 " style="padding:0">
       <div class="card" id="showNewMessage" style="cursor:pointer">
            <h5><i class="fa fa-plus" aria-hidden="true"></i>Nouveau Message</h5>
       </div>  
    </div>
</div>
<div class="row">
   <div class="card">
        <h5><i class="fa fa-list" aria-hidden="true"></i>Listes des messages recu</h5>
   </div>
</div>
<div class="row">
     <div class="card mini-card" onclick="getAllMessages()">
        <h5>Tous les messages</h5>
     </div>
     <div class="card mini-card " style="border-left:solid 8px #26A69A" onclick=" filterMessage(false)">
        <h5>Messages non lus</h5>
     </div>
     <div class="card mini-card" style="border-left:solid 8px #37474F" onclick=" filterMessage(true)">
        <h5>Messages lus</h5>
     </div>
</div>

<div class="row messages">  
</div>


<div class="ShowMessgeContent">
     <i class="fa fa-times exit" aria-hidden="true" ></i>
    <h5><i class="fa fa-graduation-cap" aria-hidden="true"></i>MLO FORMATION</h5>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-4">
            <h4>Sujet : </h4>
        </div>
        <div class="col-md-8">
            <h4 id="msg-sujet"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>Expediteur : </h4>
        </div>
        <div class="col-md-8">
            <h4 id="msg-sender"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>Date : </h4>
        </div>
        <div class="col-md-8">
            <h4 id="msg-date"></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>Message : </h4>
        </div>
        <div class="col-md-8">
            <h4 id="msg-text"></h4>
        </div>
    </div>
</div>

<div class="new-message">

     <i class="fa fa-times exit" aria-hidden="true" ></i>
    <h5><i class="fa fa-graduation-cap" aria-hidden="true"></i>MLO FORMATION</h5>
    <div class="clearfix"></div>
    <form id="form-send">
         {{csrf_field()}}
         <div class="alert alert-danger">
         </div>
         <div class="row form-group">
               <div class="col-md-4">
                   <h4>Sujet</h4>
               </div>
               <div class="col-md-6">
                   <input type="text" name="title" class="form-control" required>
               </div>
         </div>
         <div class="row form-group">
               <div class="col-md-4">
                   <h4>Message</h4>
               </div>
               <div class="col-md-6">
                  <textarea rows="6" name="message" class="form-control" required></textarea>
                  <button type="submit" class="btn btn-success" style="margin-top:10px">Envoyer</button>
               </div>
         </div>
    </form>
</div>

     <div class="success">
        <i class="fa fa-times exit" aria-hidden="true" ></i>
        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
        <h4>MLO FORMATION</h4>
        <h3>Votre Message on été envoyer avec succès</h3>
    </div>

@endsection

@section('script')
<script>
$(document).ready(function(){

  getAllMessages();
  GetAjaxData("{{route('sendMessage')}}",$("#form-send"),"POST",$(".new-message"));


  $("#showNewMessage").click(function(){
      $(".new-message").slideToggle();
       $(".back-hide").show();
  })
 
})


</script>
<script>
function getAllMessages()
{
    $(".messages").html("");
  $.ajax({
    url:"{{route('getMessages')}}",
    type:"GET",
    beforeSend:function()
    {
      $(".loading").show();
    },
    success:function(data)
    {
       
      $(".loading").hide();
      $.each(data,function(i,message){
         
         if(message.read == false) { var color = "#26A69A"; }
         else {var color = "#37474F";}
         $(".messages").append(`
                   <div class="col-md-3 card card-message" style="border-left:solid 5px `+color+`" onclick="ShowCurrentMessages(`+message.id+`,this)">
                   
                      <h4>Sujet: `+message.title+`</h4>
                      <h5>Expéditeur: `+message.Sender_name+`</h5>
                      <h6>Date: `+message.date_message+`</h6>
                  </div>
         `)
      })  
    },
    error:function()
    {
      $(".loading").hide();
      alert("Something Wron Please Contact Developer");
    }
  })
}


function filterMessage(filter)
{
        $(".messages").html("");
        if(filter==true)
        {
            url = "{{route('filtreMessages','true')}}";
        }
        else
        {
            url = "{{route('filtreMessages','false')}}";
        }

        $.ajax({
        url:url,
        type:"GET",
        beforeSend:function()
        {
        $(".loading").show();
        },
        success:function(data)
        {
                
                $(".loading").hide();
                $.each(data.messages,function(i,message){
                   
                    if(message.read == false) { var color = "#26A69A"; }
                    else {var color = "#37474F";}
                    $(".messages").append(`
                            <div class="col-md-3 card card-message" style="border-left:solid 5px `+color+`" onclick="ShowCurrentMessages(`+message.id+`,this)">
                            
                                <h4>Sujet: `+message.title+`</h4>
                                <h5>Expéditeur: `+message.Sender_name+`</h5>
                                <h6>Date: `+message.date_message+`</h6>
                            </div>
                    `)
                })  
        },
        error:function()
        {
        $(".loading").hide();
        alert("Something Wron Please Contact Developer");
        }
    })

}

function ShowCurrentMessages(messageID,currentDIV)
{   //Make Message Readed
    MakeMessageRead(messageID,currentDIV);
    $.ajax({
      url:"{{url('/ShowMessages')}}" + "?user_id="+ {{$user_id}} + "&msg_id="+messageID ,
      type:"GET",
      beforeSend:function()
      {
        $(".loading").show();
      },
      success:function(data)
      {
        $(".loading").hide();
        $(".ShowMessgeContent").slideToggle();
        $(".back-hide").show();
          if(data.success == true)
          {
            $("#msg-sujet").html(data.msg_data.title);
            $("#msg-sender").html(data.msg_data.Sender_name);
            $("#msg-date").html(data.msg_data.date_message);
            $("#msg-text").html(data.msg_data.comment);
          }
      },
      error:function()
      {
        $(".loading").hide();
        alert("Something Wron Please Contact Developer");
      }

    })
}


function MakeMessageRead(id,currentDIV)
{
  
    var url = "{{url('/')}}"+"/MakeMessageRead/"+id;
    $.ajax({
        url:url,
        data:{"_token":"{{csrf_token()}}"},
        type:"post",
        success:function()
        {
            $(currentDIV).css('border-left',"solid 5px #37474F");
            
        },
        error:function()
        {
            alert("Something Wron Please Contact Developer");
        }
    })
    CalculNotification(1);
}
</script>
@endsection
