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



class ApiController extends Controller
{
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


            $cour = new Cour();
            $cour->cours_name = $reqeust->name;
            $cour->Instructor= $reqeust->instructor;
            $cour->only_subscriber = $reqeust->subscribed;
            $cour->link = $path_cours;
            $cour->created_at = Carbon::now();
            $cour->save();
            
            Session::flash('message', "Special message goes here");
            return "Cours a été ajoute avec success";
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
           
           return Cour::all();
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
                    padding-top: 80px;> Tous les champs sont obligatoire ">
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
              
              $cours->save();
              return "Success";
         
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
}
