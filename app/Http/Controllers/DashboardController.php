<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
use Response;
use DateTime;
use View;
use App\Cour;

class DashboardController extends Controller
{   
    
 
    public function index()
     {  
            $cours = Cour::all()->sortByDesc('id')->values()->take(5);
            if(!Auth::user()->subscribed)
            {
                 
        
                 return view('Dashboard',[
                     "cours" => $cours,
                 ]);
            }



         $date_fin_subscription = Auth::user()->date_fin_subscription;

         //Calculer le temps restant pour que la subscription finis
         $date_fini = new DateTime($date_fin_subscription);
         $date_now =  new DateTime(date('Y-m-d'));
        
        //check if subscritpion has ended
         if($date_now >= $date_fini )
         {
            //If User susbcription has ended return to dashboard with message Ended
            
            return view('Dashboard',[
                "subscribed" => false,
            "subscribtion_finished"=> true, 
            ]);
         }

         //if user Still Subsribied , Calculate Days Restant
         $jours_restant =  $date_now->diff($date_fini)->format("%a");
        
         return view('Dashboard',[
             "jours_restant" =>$jours_restant ,
              "cours" => $cours,
         ]);
     }

     public function account()
     {
          $name = Auth::user()->name;
          $email = Auth::user()->email;
          $password = Auth::user()->password;
          $telephone= Auth::user()->telephone;
          $date_creation= Auth::user()->created_at;

    

         return view('Account',[
             'name' => $name ,
             'email' => $email,
             'password'=>$password,
             'telephone' => $telephone ,
             'date_creation' => $date_creation ,
          
         ]);
     }

     public function subscription()
     {
        return view('subscription');
     }




     public function changeINFO(Request $request)
     {
      
       
        //Validate Email
        if($request->has('email') )
        {
      
            $validator = Validator::make($request->all(),[
                'email'=>'required|unique:users|max:100|email',

            ]);
             if($validator->fails())
                {
                     return Response::json([
                         "success"=> false,
                         "error" => $validator->errors()->first()
                     ]);
                }
        }
        //Validate Password
        else if ($request->has('password') )
        {
                    $validator = Validator::make($request->all(),[
                        'password'=>'required|max:100|min:6',
                    ]);
                    if($validator->fails())
                        {
                            return Response::json([
                                "success"=> false,
                                "error" => $validator->errors()->first()
                            ]);
                         
                        }
        }
        //Validate Telephone
         else if ($request->has('telephone'))
        {
                     $validator = Validator::make($request->all(),[
                        'telephone'=>'required|numeric',
                    ]);
                    if($validator->fails())
                        {
                            return Response::json([
                                "success"=> false,
                                "error" => $validator->errors()->first()
                            ]);
                        }
                        
                     if(strlen($request->telephone) != 10)
                     {
                         return Response::json([
                                "success"=> false,
                                "error" => 'Numéro de téléphone doivent contenir 10 chiffres',
                            ]);
                     }
        }
      
       //Search User Information
       $id = Auth::user()->id;
       $user = User::find($id);
       
       //For vurnability , Check if all fields are Set
       if($request->email != '')
       {
           $user->email = $request->email;
       }
       if ($request->password != '')
       {
           $user->password = Hash::make($request->password);
       }
       if($request->telephone != '')
       {
          $user->telephone = $request->telephone;
       }
      
       $user->save();
          return Response::json([
            'success'=> true
        ]);
     }
}
