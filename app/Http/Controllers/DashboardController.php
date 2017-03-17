<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;
use Response;
class DashboardController extends Controller
{
    public function index()
     {
         return view('Dashboard');
     }

     public function account()
     {
          $name = Auth::user()->name;
          $email = Auth::user()->email;
          $password = Auth::user()->password;
          $telephone= Auth::user()->telephone;
          $date_creation= Auth::user()->created_at;
          //Check subscirption
          if(Auth::user()->subscribed == false)
          {
             $subscribed = "Non" ;
          }
          else
          {
              $subscribed = "Oui" ;
          }

         return view('Account',[
             'name' => $name ,
             'email' => $email,
             'password'=>$password,
             'telephone' => $telephone ,
             'subscribed' => $subscribed ,
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
                     if(strlen($request->telephone) <10 || strlen($request->telephone) >20)
                     {
                        return 'Numerau du Téléphone est invalide';
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
