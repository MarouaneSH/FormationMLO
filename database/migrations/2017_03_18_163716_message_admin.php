<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_admins', function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('user_id');
                    $table->string('title');
                    $table->string('comment');
                    $table->date('date_message');
                    $table->boolean('read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages_users');
    }
}
