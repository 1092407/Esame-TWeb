<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmici extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amici', function (Blueprint $table) {
            $table->bigIncrements('id')->index();

            $table->integer('utente_riferimento')->references('id')->on('users')->index();        // avro molte tuple per registare tutte le amicizie possibili tra tutti gli utenti registrati al sito
            $table->integer('amico_utente_riferimento')->references('id')->on('users')->index();

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
        Schema::dropIfExists('amici');
    }
}
