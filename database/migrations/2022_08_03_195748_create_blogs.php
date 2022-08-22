<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id')->index();


            $table->string('titolo',30);

            $table->longText('descrizione');      // specifica il contenuto del blog in modo piu esaustivo del titolo

            $table->integer('utente_proprietario')->references('id')->on('users');  //utente che ha creato il blog
        //   $table->integer('amico_proprietario')->references('id')->on('users');     // utente amico del proprietario che puo quindi leggere il blog e postare messaggi
            $table->timestamps();                                                     // ci sarnno piu tuple che differiscono solo per questo campo : utente A prorpietario di un certo blog ha n amici che possono leggere e o scrivere sul suo blog ---> allora ho n tuple che mi dicono gli n amici di A che sono autorizzati


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
