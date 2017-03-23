
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
    .AddCours{
  
        width: 100%;
        height: 100vh;;
        background: #19b395;
        z-index: 100;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        border: solid rgba(21, 19, 19, 0.64);
        text-align: center;
        color: white;
    }
    button
    {
        background:#3E454C;
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
        <form action="{{route('StoreBooks')}}" id="form_ADDCOURS" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row form-group">
                   <div class="col-md-4">
                       <input type="hidden" name="key" value="MarouaneSH-api"> 
                   </div>
                   <div class="col-md-6">
                        <h4 >Ajouter un nouveau Cours</h4>
                   </div>
                </div>
                <div class="row form-group">
                   <div class="col-md-4">
                        Nom de Cours
                   </div>
                   <div class="col-md-6">
                        <input type="text" name="name" class="form-control">
                   </div>
                </div>
                <div class="row form-group">
                   <div class="col-md-4">
                        Instructor
                   </div>
                   <div class="col-md-6">
                        <input type="text" class="form-control" value="Admin" name="instructor">
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
                        
                   </div>
                </div>
                <div class="row form-group">
                   <div class="col-md-4">
                       document supplémentaire
                   </div>
                   <div class="col-md-6">
                        <input type="file" name="docs[]" multiple>
                 
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
