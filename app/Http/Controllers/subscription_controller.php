<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verification_paiement;


class subscription_controller extends Controller
{
   public function store(Request $request)
   {
    
      $demande = new Verification_paiement();
      // $demande->name_account = $request->name_account;
      // $demande->email = $request->email;
      // $demande->telephone = $request->telephone;
      // $demande->name_payeur = $request->name_payeur;
      // $demande->date_demande = $request->date_demande;
      // $demande->date_paiement= $request->date_paiement;
      // $demande->banque= $request->banque;
      $demande->name_account = "sddsdssd";
      $demande->email = "$request->email";
      $demande->telephone = "$request->telephone";
      $demande->name_payeur = "$request->name_payeur";
      $demande->date_demande = "$request->date_demande";
      $demande->date_paiement= "$request->date_paiement";
      $demande->banque=" $request->";
      $demande->save();
      
      return 'yay';

   }
}
