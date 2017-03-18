<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Messages_user;
use App\User;
use Illuminate\Support\Facades\DB;
use Response;
use App\Messages_admin;
use Validator;
use Carbon\Carbon;

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

    //Send Message To Admin
    public function sendMessage(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
           "title" => "required|max:200",
           "message" => "required|max:1000",
        ]);
        if($validation->fails())
        {
            return Response::json([
                "success" => false,
                "errors" => $validation->errors()
            ]);
        }
        $message = new Messages_admin();
        $message->user_id = Auth::user()->id;
        $message->title = $request->title;
        $message->comment = $request->message;
        $message->date_message = Carbon::now();
        $message->read = false;
        $message->save();   
        return Response::json([
                "success" => true,
            ]);
    }
    
    public function MakeMessageRead($msg_id)
    {
        if(request()->ajax())
        {
             $message = Messages_user::findOrFail($msg_id);
             //For Security Check if Message Belogn to user
             if($message->user ==  Auth::user()->id)
             {
                    $message->read = true;
                    $message->save();
                    return Response::json([
                        "success" => true,
                        "message"=>$message
                    ]);
             }
             else
             {
                 return "Access Denied";
             }
        }
        return "Access Denied";
       
    }
}
