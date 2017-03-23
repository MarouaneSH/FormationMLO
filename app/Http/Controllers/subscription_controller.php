<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verification_paiement;
use Auth;
use Carbon\Carbon;
use Validator;
use Response;
use App\Paiement_code;
use App\User;

class subscription_controller extends Controller
{
   public function store(Request $request)
   {
      $validation = Validator::make($request->all(),
      [
          "name_payeur" => "required|max:100",
          "date"=> "required|date_format:Y-m-d|max:50|",
          "banque"=>"required_without:AutreBanque|max:50",
          "AutreBanque" => "required_without:banque|max:100",
      ]);
      if($validation->fails())
      {
                return Response::json([
                "success"=> false,
                "errors"=>$validation->errors()
            ]);
      }

      $demande = new Verification_paiement();
      $demande->user_id = Auth::user()->id ;
      $demande->name_payeur = $request->name_payeur;
      $demande->date_demande = Carbon::now();
      $demande->date_paiement= $request->date;
      if($request->has("banque"))
      {
           $demande->banque=$request->banque;
      }
      else
      {
          $demande->banque=$request->AutreBanque;
      }
     
      $demande->save();
      
      return Response::json([
          "success"=> true
      ]);

   }

   public function subscribe_user(Request $request)
   {
      
        if($request->has('code'))
        {
           
           

           
            $code = Paiement_code::where('code',$request->code)->first();
            if($code==null)
            {
                 return Response::json([
                        "success"=> false,
                        "message"=> "Code Incorrect "
                    ]);
            }
            else
            {
                if($code->used==false)
                {
                    //  Make message readed
                    $code->used=true;
                    $code->user_id = Auth::user()->id;
                    $code->save();

                    //Susbcribe user_error
                     $date_subsribe = Carbon::now()->subDay()->format('Y-m-d');
                     $date_finish = date('Y-m-d', strtotime($date_subsribe . ' + 30 days'));

                    $user = User::find(Auth::user()->id);
                    $user->subscribed =true;
                    $user->date_subscription = $date_subsribe;
                    $user->date_fin_subscription = $date_finish;
                    $user->save();
                    return Response::json([
                        "success"=> true,
                        
                    ]);
                }
                else
                {
                     return Response::json([
                        "success"=> false,
                        "message"=> "Ce code est déja utilisé"
                    ]);
                }
            }
        }
        else
        {
            return "access Denied";
        }
   }
}
