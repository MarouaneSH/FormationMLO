<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
     <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
     <style>
     body
     {
         background:#F1F3F6;
         padding-top:50px;
     }
     .getAllUsers
     {
         position:fixed;
         width:70%;
         height:400px;
         overflow:auto;
         background:#f9f9f9;
         top:0;
         display:none;
     }
     table.dataTable tbody tr:hover
     {
         background:#19B395;
         cursor:pointer;
         color:white;
     }
     .users-table_wrapper
     {
         background:#f9f9f9;
     }
     </style>
</head>
<body>
<div class="container-fluid">
<div class="message-send">
    <form id="formMsg" >
        {{csrf_field()}}
        <input type="hidden" name="key" value="MarouaneSH-api">
        <div class="row form-group">
            <div class="col-md-2 .col-sm-2">
                Sujet
            </div>
            <div class="col-md-10 col-sm-9">
                <input type="text" class="form-control" name="sujet">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2 .col-sm-2">
                Message
            </div>
            <div class="col-md-10 col-sm-9">
                <textarea name="message" class="form-control" id="" cols="30" rows="10" ></textarea>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2 .col-sm-2">
                Envoyer a 
            </div>
            <div class="col-md-10 col-sm-9">
                <select name="select" class="form-control" id="select">
                    <option value="tous">Tous les utilisateur</option>
                    <option value="specific">Choisissez un utilisateur</option>
                </select>
                <h6 id="selectUser" style="color:#2196F3;font-weight:bold;cursor:pointer;display:none">Selectioner un utilisateur</h6>
                <input type="hidden" id="user_id" name="user_id">
                <h4 id="msg-to" style="display:none;font-size: 16px;">
                 Message Sera Envoyer à <span style="color:#2196F3;font-weight:bold" id="user_name">marouane</span> 
                 </h4>
                <center>
                    <button type="submit" class="btn btn-success" style="margin-top:30px">Envoyer</button>
                </center>
            </div>
        </div>
    </form>
</div>
<div class="select_user col-md-7" style="margin-top:50px;display:none">
     <table class="table table-condensed" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Telephone</th>
               
            </tr>
        </thead>
     </table>
</div>

</div>


<script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>

var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        select: true,
        ajax: 'http://localhost:8000/api/getUsersDatatable?key=MarouaneSH-api',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'telephone', name: 'telephone' },
     
        ]
    });

    $('#users-table tbody').on( 'click', 'tr', function () {
                $("#user_id").val( table.row( this ).data().id );
                $("#user_name").html( table.row( this ).data().name);
                $("#msg-to").show();
        } );

var tableShow = false;
$("#selectUser").click(function(){
    if(!tableShow )
    {
        $(this).html("Selectioner Tous Les Utilisteur");
        $(".message-send").addClass('col-md-5');
        $(".select_user").slideDown();
         tableShow=true;
    }
    else
    {
        $(this).html("Selectioner un utilisateur");
        $(".message-send").removeClass('col-md-5');
        $("#select").val("tous");
        $("#selectUser").hide();
        $("#msg-to").hide();
         $(".select_user").hide();
        tableShow=false;
    }
   
})


 $("#formMsg").submit(function(e){
     e.preventDefault();
     $.ajax({
         url:"{{route('NewMessage')}}",
         type:"POST",
         data:$(this).serialize(),
         success:function(data){
            if(data.success==true)
            {
                
                alert("Message a été envoyer avec success");
            }
            else
            {
                console.log(data);
                alert(data.message);
            }
         },
         error:function(){
             alert("Something Wrong Please Contact Developer");
         }
     })
 })



 $("#select").on("change",function(){
    if($(this).val() =="tous")
    {
        $("#selectUser").hide();
        $("#msg-to").hide();
          $("#selectUser").html("Selectioner un utilisateur");
        $(".message-send").removeClass('col-md-5');
         $(".select_user").hide();
    }
    else
    {
         $("#selectUser").show();
    }
 })
</script>


</body>
</html>