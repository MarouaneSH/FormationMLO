<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Messages_user;
use App\User;
use Illuminate\Support\Facades\DB;
use Response;

class MessageUserController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
    return view("message",["user_id"=> $user_id ]);
    }

    //get Messages
    public function get()
    {
        if (request()->ajax())
        {
            $messages = User::find(Auth::user()->id)->Messages_user->sortByDesc('id')->values();
             return $messages;
        }
        return "Access Denied";
    }

    //Show Messages By is_day()
    public function ShowMessage(Request $request)
    {
          if (request()->ajax())
           {
            if($request->has("user_id") && $request->has("msg_id"))
            {
               
                if($request->user_id == Auth::user()->id)
                {
                    return Response::json([
                            "success"=> true,
                            "msg_data"=> User::find(Auth::user()->id)->Messages_user->where("id",$request->msg_id)->first(),
                        ]);
            
                }
            }
        }
        return Response::json([
            "success"=> false,
            "Message"=> "Access Denied",
        ]);
    }

    //Filter ShowMessage
    public function FiltreMessage($read)
    {
         if($read == "true")
         {
              $messages = User::find(Auth::user()->id)->Messages_user->where('read',true)->sortByDesc('id')->values();
         }
         else if ($read =="false")
         {
              $messages = User::find(Auth::user()->id)->Messages_user->where('read',false)->sortByDesc('id')->values();
         }
         else
         {
             return "Access Denied";
         }
         return Response::json([
             "success"=> true,
             "messages"=>$messages
         ]);
        

    }
}
