<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;
class CoursController extends Controller
{
     public function index()
    {   
        $cours = Cour::all()->sortByDesc('id')->values();
        return view('cours',
        [
            "cours"=> $cours,
        ]);
    }
}
