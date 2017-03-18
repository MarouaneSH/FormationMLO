<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class DemandeVerficatioPaiement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('demande_verification_paiement')->insert([
            'user_id' => '1',
            'name_payeur' => 'AHAMED',
            'date_demande'=> Carbon::now(),
            'date_paiement' => Carbon::now(),
            'banque'=> "BMCE BANQUE"           
        ]);
    }
}
