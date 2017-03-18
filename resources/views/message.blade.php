@extends('layouts.main')
@section('style')
<link rel="stylesheet" href="{{asset('css/MessageCss.css')}}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-5 " style="padding:0">
       <div class="card">
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
     <div class="card mini-card">
        <h5>Tous les messages</h5>
     </div>
     <div class="card mini-card " style="border-left:solid 8px #26A69A">
        <h5>Messages non lus</h5>
     </div>
     <div class="card mini-card" style="border-left:solid 8px #37474F" >
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
@endsection

@section('script')
<script>
$(document).ready(function(){

  getAllMessages("none");

})


</script>
<script>
function getAllMessages(filter)
{
  if(filter==true)
  {
      url = "{{route('filtreMessages','true')}}";
  }
  else if (filtre ==false)
  {
      url = "{{route('filtreMessages','false')}}";
  }
  else
  {
      url = "{{route('getMessages')}}";
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
      $.each(data,function(i,message){
         
         if(message.read == false) { var color = "#26A69A"; }
         else {var color = "#37474F";}
         $(".messages").append(`
                   <div class="col-md-3 card card-message" style="border-left:solid 5px `+color+`" onclick="ShowCurrentMessages(`+message.id+`)">
                   
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


function ShowCurrentMessages(messageID)
{ 
  
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
        $(".ShowMessgeContent").show();
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
</script>
@endsection