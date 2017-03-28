
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
    body
    {
          background:#F1F3F6
    }
    .AddCours{
  
       background:#F1F3F6
    }
    button
    {
        background:#3E454C;
        color:white;
        border:none;
      
    }
    .loading
        {
                background: #587073;
            position: absolute;
            top: 60px;
            width: 50%;
            text-align: center;
            padding: 50px;
            margin: 0 auto;
            left: 0;
            right: 0;
            border: solid #ad9797 1px;
            color: white;
          
        }
    </style>
</head>
<body>
    {{Session::has('message')}}
    <div class="container AddCours">
        <form action="{{route('AddDocBiblio')}}" id="form_ADDCOURS" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row form-group">
                   <div class="col-md-4">
                       <input type="hidden" name="key" value="MarouaneSH-api"> 
                   </div>
                   <div class="col-md-6">
                        <h4 >Ajouter un nouveau Documetn au bibliotheque</h4>
                   </div>
                </div>
                <div class="row form-group">
                   <div class="col-md-4">
                        Nom de document
                   </div>
                   <div class="col-md-6">
                        <input type="text" name="name" class="form-control">
                   </div>
                </div>
          
                <div class="row form-group">
                   <div class="col-md-4">
                        Only Subscribed
                   </div>
                   <div class="col-md-6">
                        <select name="subscribed" id="" class="form-control" >
                            <option value="1">Oui</option>
                            <option value="0">NON</option>
                        </select>
                   </div>
                </div>
                <div class="row form-group">
                   <div class="col-md-4">
                        Fichier de Cours
                   </div>
                   <div class="col-md-6">
                        <input type="file" name="file">
                        <button style="margin-top:50px;padding:20px">Ajouter le cours</button>
                   </div>
                </div>

        </form>
          
   </div>
 
 
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
   <script>
 
   
   </script>
</body>
</html>
