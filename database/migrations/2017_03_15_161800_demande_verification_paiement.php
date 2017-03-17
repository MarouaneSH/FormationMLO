<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DemandeVerificationPaiement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('demande_verification_paiement', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_account');
            $table->string('email');
            $table->string('telephone');
            $table->string('name_payeur');         
            $table->date('date_demande');
            $table->date('date_paiement');
            $table->date('banque');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
