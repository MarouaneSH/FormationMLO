<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Response;
use App\User;
use App\Messages_admin;
use App\Cour;
use Carbon\Carbon;


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

   public function AddBooks(Request $reqeust)
   {
       
       if($reqeust->key == "MarouaneSH-api")
       {
         $cour = new Cour();
         $cour->cours_name = $reqeust->name;
         $cour->Instructor= $reqeust->instructor;
         $cour->only_subscriber = $reqeust->subscribed;
         $cour->link =$reqeust->link;
         $cour->created_at = Carbon::now();
         $cour->save();
       }
        else
       {
           return "Access Denied";
       }
   }


}
