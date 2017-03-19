<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\User;

class ApiController extends Controller
{
   public function ShowUser(Request $reqeust)
   {
       if($reqeust->key == "MarouaneSH-api")
       {
           return User::all();
           return Response::json([
                                [
                                    "Nom"=> "Mohamedd",
                                    "prenom" => "Hola"
                                ],
                                [
                                    "Nom" => "Marwan",
                                    "prenom" => "TEST"
                                ],
                                [
                                    "Nom" => "KAM",
                                    "prenom" => "TES 2"
                                ]
                            ]);
       }
       
       
   }
}
