<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verification_paiement;
use Auth;
use Carbon\Carbon;
use Validator;
use Response;

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
}
