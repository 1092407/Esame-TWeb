<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRichieste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('richieste', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->date('data_richiesta')->index();
            $table->date('data_risposta')->index()->nullable();

            $table->integer('stato')->index();   // mi serve per capire se viene accettata o negata
            $table->integer('richiedente')->references('id')->on('users');  // chi invia ad un altro utente una richiesta di amicizia
            $table->integer('accettante')->references('id')->on('users');    // cho riceve una richista da un richidente e puo decidere se accettare o rifiutare
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
        Schema::dropIfExists('richieste');
    }
}
