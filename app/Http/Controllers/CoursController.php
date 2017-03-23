<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;
use App\User;
use App\Cours_docs;
use Response;

class CoursController extends Controller
{
     public function index()
    {   
        $cours = Cour::all()->sortByDesc('id')->values();
        $users = User::all();
        return view('cours',
        [
            "cours"=> $cours,
        ]);
    }

    public function getDocs(Request $request)
    {
        if($request->ajax())
        {
            $docs = Cours_docs::where('cours_id',$request->cours_id)->get();
         
            return Response::json([
                "success" => true,
                "docs_link"=>$docs
            ]);
        }
        else
        {
            return "Access Denied";
        }
    }
}
