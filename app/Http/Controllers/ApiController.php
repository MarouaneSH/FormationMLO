<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\User;
use App\Messages_admin;

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



}
