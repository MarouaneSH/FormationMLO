<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
              $this->call(MessageUsersSeeder::class);
              $this->call(CoursSeeder::class); 
              $this->call(MessageAdminSeeder::class);
               $this->call(DocSeeder::class);
      
    }
}
