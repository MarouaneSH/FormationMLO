<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cours')->insert([
            [
            'id' => '1',
            'cours_name' => 'COURS Télévente',
            'Instructor'=> 'Admin',
            'only_subscriber' => '0',
            'link' => 'http://localhost:8000/storage/cours/story_html5.html',
            'created_at'=> Carbon::now(),           
           ],
           [
             'id' => '2',
            'cours_name' => 'COURS 2',
            'Instructor'=> 'Admin',
            'only_subscriber' => '0',
            'link' => 'http://localhost:8000/storage/cours/story_html5.html',
            'created_at'=> Carbon::now(), 
           ],
           [
             'id' => '3',
            'cours_name' => 'COURS 3',
            'Instructor'=> 'Admin',
            'only_subscriber' => '1',
            'link' => 'http://localhost:8000/storage/cours/story_html5.html',
            'created_at'=> Carbon::now(), 
           ],

        ]);
    }
}
