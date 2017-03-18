<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class MessageAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages_admins')->insert([
            [
            'user_id'=> "1",
            'title' => str_random(5),
            'comment' => str_random(30),
            'date_message'=> Carbon::now(),
            'read'=>false,   
            ]
        ]);
    }
}
