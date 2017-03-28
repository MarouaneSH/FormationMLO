<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\User;
use App\Messages_admin;
use App\Cour;
use Carbon\Carbon;
use Storage;
use ZipArchive;
use Session;
use Redirect;
use App\Paiement_code;
use Illuminate\Support\Facades\Input;
use App\Cours_docs;
use App\Messages_user;
use Datatables;
use App\Verification_paiement;
use App\Bibliotheque;
use App\Problem;

class ApiController extends Controller
{
    public function getUsersDatatable(Request $reqeust)
    {
        if($reqeust->key == "MarouaneSH-api")
       {
           return Datatables::eloquent(User::query())->make(true);
        
       }
       else
       {
           return "Access Denied";
       }
    }
   public function ShowUser(Request $reqeust)
   {
       if($reqeust->key == "MarouaneSH-api")
       {
          
           return User::all();
       }
       else
       {
           return "Access Denied";
       }
   }
   public function getUser(Request $reqeust)
   {
      if($reqeust->key == "MarouaneSH-api")
       {
           return User::find($reqeust->id);
       }
       else
       {
           return "Access Denied";
       }

   }

   public function ShowMessages(Request $reqeust)
   {
       if($reqeust->key == "MarouaneSH-api")
       {
           //Here i send Data
           return Messages_admin::all()->sortByDesc("id")->values();
       }
       else
       {
           return "Access Denied";
       }
   }

   public function AddBooks(Request $reqeust)
   {
        
       if($reqeust->key == "MarouaneSH-api")
       {

        return view('api.addbooks',["success"=>"false"]);
       
       }
        else
       {
           return "Access Denied";
       }
   }
   
   public function StoreBooks(Request $reqeust)
   {
       
       if($reqeust->key =="MarouaneSH-api")
       {
          $validation = Validator::make($reqeust->all(),[
              "name" => "required",
              "instructor" => "required",
              "file"=>"required",
          ]);

          if($validation->fails())
          {
              return $validation->errors();
              return '<h1 style= "
                    
                    height: 100%;
                    background: #19b395;
                    color: white;
                    text-align: center;
                    padding-top: 80px;> Tous les champs sont obligatoire ">
                    Tous les champs sont obligatoire
                     <a  href="http://localhost:8000/api/AddBooks?key=MarouaneSH-api" style="color:blue">Retry</a>
                    </h1>
                   
                    ';
          }



           $file = $reqeust->file;
           $random_name = str_random(15);
           $full_file_name = $random_name ."--".$file->getClientOriginalName();
           $extension =  $file->getClientOriginalExtension(); 

           if($extension=="zip")
           {
                  $url = Storage::putFileAs("public/cours_zip"  , $file ,  $full_file_name);
         
                    //When uplouad to ftp mus delete \\\\
                    $path_to_unzip =  storage_path().'\app\\'. str_replace("/","\\", $url);
                    $path_to_store = storage_path().'\app\public\Cours\\' .$full_file_name ;

                    //unzip file 
                    $zip = new ZipArchive;
                        if ($zip->open($path_to_unzip) === TRUE) {
                            $zip->extractTo($path_to_store);
                            $zip->close();
                        } 
                        else {
                            return "Unzip de fichier a été echoué";
                        }
                        //END UNZIP

                        $path_cours= "/storage/Cours/".$full_file_name."/story_html5.html";
           }
          else
          {
               $url = Storage::putFileAs("public/cours_single"  , $file ,  $full_file_name);
               $path_cours="/storage/cours_single/".$full_file_name;
          }
            
            $cour = new Cour();
            $cour->cours_name = $reqeust->name;
            $cour->Instructor= $reqeust->instructor;
            $cour->only_subscriber = $reqeust->subscribed;
            $cour->link = $path_cours;
            $cour->created_at = Carbon::now();
            $cour->save();
          
            //Store Docs to this Cours
            if($reqeust->hasFile('docs'))
            {
               
                $docs = $reqeust->docs;
                foreach(Input::file("docs") as $doc) {
                        $docs_name = "MLO-FORMATION-".str_random(8).$doc->getClientOriginalName();
                        $url = Storage::putFileAs("public/cours_docs"  , $doc ,$docs_name  );
                        $document = new Cours_docs();
                        //give the ID of the current Cour
                        $document->cours_id =$cour->id;
                        $document->Nom=$doc->getClientOriginalName();
                        $document->extension = $doc->getClientOriginalExtension();
                        $document->link ="/storage/cours_docs/".$docs_name ;
                        $document->save();              
                    }
               
            }
            

            return '<h1 style= "
                    
                    height: 100%;
                    background: #19b395;
                    color: white;
                    text-align: center;
                    padding-top: 80px;>  ">
                    Le Cours a été ajouté avec success
                
                    </h1>
                   
                    ';
       }
       else
       {
          return "Acces denied";
       }
   }

   public function getAllCours(Request $reqeust)
   {
       if($reqeust->key =="MarouaneSH-api")
       {
           
           return Cour::all()->sortByDesc("id")->values();
       }
       else
       {
          return "Acces denied";
       }
   }

   function RemoveCours(Request $reqeust)
   {
        if($reqeust->key =="MarouaneSH-api")
        {
      
            $cour = Cour::find($reqeust->id);
            $cour->delete();

            return Response::json([
                "success"=> "true"
            ]);
        }
        else
        {
            return "Acces denied";
        }
   }
   function editCours(Request $reqeust)
   {
       
       if($reqeust->key =="MarouaneSH-api")
        {

            $validation = Validator::make($reqeust->all(),[
              "name" => "required",
              "instructor" => "required",
              "id" => "required"
          ]);

          if($validation->fails())
          {
              return $validation->errors();
            return '<h1 style= "
                    
                    height: 100%;
                    background: #19b395;
                    color: white;
                    text-align: center;
                    padding-top: 80px;> Le nom est obligatoire">
                    Tous les champs sont obligatoire
                     <a  href="http://localhost:8000/api/ModifyBooks" style="color:blue">Retry</a>
                    </h1>
                   
                    ';
            }
                        $cours = Cour::find($reqeust->id);
                        $cours->cours_name = $reqeust->name;
                        $cours->Instructor = $reqeust->instructor;
                        $cours->only_subscriber = $reqeust->subscribed;
                        //Not yet Saved , check if request ahs file

                        
                if($reqeust->hasFile("file"))
                {
                   
                
                    $file = $reqeust->file;
                    $random_name = str_random(15);
                    $full_file_name = $random_name ."--".$file->getClientOriginalName();
                    
                    $extension =  $file->getClientOriginalExtension(); 

                        if($extension=="zip")
                        {

                            $url = Storage::putFileAs("public/cours_zip"  , $file ,  $full_file_name);
                            
                            //When uplouad to ftp mus delete \\\\
                            $path_to_unzip =  storage_path().'\app\\'. str_replace("/","\\", $url);
                            $path_to_store = storage_path().'\app\public\Cours\\' .$full_file_name ;

                            //unzip file 
                            $zip = new ZipArchive;
                                if ($zip->open($path_to_unzip) === TRUE) {
                                    $zip->extractTo($path_to_store);
                                    $zip->close();
                                } 
                                else {
                                    return "Unzip de fichier a été echoué";
                                }
                                //END UNZIP

                                $path_cours= "/storage/Cours/".$full_file_name."/story_html5.html";
                                

                                //Modify Cours 
                                $cours->link = $path_cours;
                        }
                        else
                        {
                             $url = Storage::putFileAs("public/cours_docs"  , $file ,  $full_file_name);
                             $path_cours="storage/cours_docs/".$full_file_name;
                             $cours->link = $path_cours;
                        }
                    }
              
              $cours->save();
               return '<h1 style= "
                    
                    height: 100%;
                    background: #19b395;
                    color: white;
                    text-align: center;
                    padding-top: 80px;> Le nom est obligatoire">
                    Success ! le cours a été modifier avec success
                    </h1>
                   
                    ';
         
        }
        else
        {
            return "Acces denied";
        }
   }

   public function ModifyBooks(Request $reqeust)
   {
       return view("api/ModifyBooks",[
           "name"=> $reqeust->name,
           "instructor"=>$reqeust->instructor,
           "subscribed"=>$reqeust->subscribed,
           "id"=>$reqeust->id
       ]);
   }

   public function generateCode(Request $reqeust)
   {
        if($reqeust->key =="MarouaneSH-api")
        {
            $code = new Paiement_code();
            $code->code=$reqeust->code;
            $code->used= false;
            $code->save();
            return "Successs";
        }
         else
        {
            return "Acces denied";
        }
   }


   public function NewMessage(Request $reqeust){
       if($reqeust->key =="MarouaneSH-api" )
       {
          return view("api.NewMessage");
       }
        else
        {
            return "Acces denied";
        }
   }

   public function postMessage(Request $reqeust)
   {
        if($reqeust->key =="MarouaneSH-api" )
       {
          $validation = Validator::make($reqeust->all(),[
              "sujet"=>"required",
              "message"=>"required"
          ]);

                  if($validation->fails())
                  {
                      return Response::json([
                          "success"=>false,
                          "message"=>"Tous les champs sont obligatoire",
                      ]);
                  }

                if($reqeust->select=="tous")
                {
                    $users= User::all();

                    foreach($users as $user)
                    {
                        $message = new Messages_user();
                        $message->comment = $reqeust->message;
                        $message->title = $reqeust->sujet;
                        $message->date_message= Carbon::now();
                        $message->Sender_name = "Admin";
                        $message->read = false;
                        $message->user =$user->id;
                        $message->save();  
                    }

                    return Response::json([
                        "success"=>true,
                        
                    ]);
                }
                else
                {
                    if($reqeust->has("user_id"))
                    {
                            $message = new Messages_user();
                            $message->comment = $reqeust->message;
                            $message->title = $reqeust->sujet;
                            $message->date_message= Carbon::now();
                            $message->Sender_name = "Admin";
                            $message->read = false;
                            $message->user = $reqeust->user_id;
                            $message->save();  
                        return Response::json([
                        "success"=>true,
                       
                       ]);
                    }
                    else
                    {
                        return Response::json([
                        "success"=>false,
                        "message"=>"Vous devez Selectionner un utilisateur"
                       ]);
                    }
                }

          
       }
        else
        {
           return Response::json([
                        "success"=>false,
                        "message"=>"Access denied"
                       ]);
        }
   }

   public function paiementCode(Request $reqeust)
   {
       if($reqeust->key =="MarouaneSH-api" )
       {
             return Paiement_code::with('User')->orderByDesc('id')->get();
       }
       else
       {
           return "Access denied";
       }
      
   }

     public function demandeVerification(Request $reqeust)
   {
       if($reqeust->key =="MarouaneSH-api" )
       {
             return User::with('Verification_paiement')->where('subscribed',"0")->orderByDesc('id')->get();
       }
       else
       {
           return "Access denied";
       }
      
   }

   public function PostBiblio(Request $reqeust)
   {
       if($reqeust->key =="MarouaneSH-api" )
       {
             return view('api.addBiblio');
       }
       else
       {
           return "Access denied";
       }
   }
   public function AddDocBiblio(Request $reqeust)
   {
       if($reqeust->key =="MarouaneSH-api" )
       {
              
       if($reqeust->key =="MarouaneSH-api")
       {
           
                    $validation = Validator::make($reqeust->all(),[
                        "name" => "required",
                     
                        "file"=>"required",
                    ]);

                    if($validation->fails())
                    {
              
                        return '<h1 style= "
                                
                                height: 100%;
                                background: #F1F3F6;
                                color: black;
                                text-align: center;
                                padding-top: 80px;> Tous les champs sont obligatoire ">
                                Tous les champs sont obligatoire
                                <a  href="http://localhost:8000/api/PostBiblio?key=MarouaneSH-api" style="color:blue">Retry</a>
                                </h1>
                            
                                ';
                    }
                
                        $file = $reqeust->file;
                        $random_name = str_random(15);
                        $full_file_name = $random_name ."--".$file->getClientOriginalName();
                        $extension =  $file->getClientOriginalExtension(); 
                        
                         $url = Storage::putFileAs("public/biblothque"  , $file ,  $full_file_name);
                         $path_cours="/storage/biblothque/".$full_file_name;
                        
                        $bibliotheque = new Bibliotheque();
                        $bibliotheque->name = $reqeust->name;
                        $bibliotheque->link = $path_cours;
                        $bibliotheque->type = $extension ;
                        $bibliotheque->only_subscribe = $reqeust->subscribed;
                        $bibliotheque->save();
                       return '<h1 style= "
                    
                    height: 100%;
                    background: #F1F3F6;
                    color: black;
                    text-align: center;
                    padding-top: 80px;> Le nom est obligatoire">
                    Success ! le document a été modifier avec success
                    </h1>
                   
                    ';
       }
       else
       {
           return "Access denied";
       }
    }
   }


   public function problems(Request $reqeust)
   {
       if($reqeust->key =="MarouaneSH-api" )
       {
             return Problem::all();
       }
       else
       {
           return "Access denied";
       }
   }
}
