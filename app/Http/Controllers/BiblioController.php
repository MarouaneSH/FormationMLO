<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bibliotheque;
use Illuminate\Support\Facades\DB;
class BiblioController extends Controller
{
    public function index()
    {
        return view('bibliotheque',[
            "docs"=>Bibliotheque::paginate(20),
        ]);
    }
}
