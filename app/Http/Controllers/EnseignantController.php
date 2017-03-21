<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        return view('Enseignant.dashboard');
    }
}
