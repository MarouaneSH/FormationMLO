<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoursController extends Controller
{
     public function index()
    {
        //For security Raison , if user has ended subscirption and want to this route
        $s = new DashboardController();
        
        return view('cours');
    }
}
