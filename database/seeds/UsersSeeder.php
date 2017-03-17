<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'Marouane',
            'email' => 'test'.'@gmail.com',
            'password' => bcrypt('secret'),
            'telephone' => '064546897',
            'date_subscription' => Carbon::now(),
            'messages' => 'UIahzizaazhzaihazuhaua',
            'paiement' => 'XQAZ-45',

        ]);
    }
}
