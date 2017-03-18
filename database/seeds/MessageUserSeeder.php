<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class MessageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages_users')->insert([
            [
            'user' => '1',
            'Sender_name'=> "Admin",
            'title' => str_random(5),
            'comment' => str_random(30),
            'date_message'=> Carbon::now(),
            'read'=>false,   
            ],
            [
            'user' => '1',
            'Sender_name'=> "Admin",
            'title' => str_random(5),
            'comment' => str_random(30),
            'date_message'=> Carbon::now(),
            'read'=>false,   
            ],
        ]);
    }
}
