<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
             Schema::create('cours', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('cours_name');
                    $table->string('Instructor');
                    $table->boolean('only_subscriber');
                    $table->date('created_at');
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
