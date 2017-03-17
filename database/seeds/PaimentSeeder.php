<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paiements')->insert([
            'code' => 'Marouane',
            'user' => 'test'.'@gmail.com',
            'date_paiment' => Carbon::now(),


        ]);
    }
}
