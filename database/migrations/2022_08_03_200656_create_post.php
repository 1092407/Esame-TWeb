<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->bigIncrements('id')->index();

             $table->integer('blog')->references('id')->on('blogs');  // blog tra tutti i blogs su cui un utente va a postare un messaggio

             $table->integer('user_scrittore')->references('id')->on('users');  //utente che va a postare  su un blog
             $table->longText('contenuto');  // contenuto del post che lo scrittore vuole pubblicare
             $table->dateTime('data')->index();  // data in cui lo scrittore posta qualcosa sul blog

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
}
