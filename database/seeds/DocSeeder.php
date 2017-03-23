<?php

use Illuminate\Database\Seeder;

class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cours_docs')->insert([
            'id' => '1',
            "cours_id"=>1,
            'extension' => 'cours_id',
            'link'=> "sddsdsdds",       
        ]);
    }
}
