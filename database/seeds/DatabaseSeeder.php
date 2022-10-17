<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
Use Carbon\Carbon;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run() {

  DB::table('users')->insert([
            ['foto_profilo' => NULL, 'name' => 'Admin', 'cognome' => 'Admin', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','01','01'), 'email' => 'admin.admin@blo.it', 'username' => 'adminadmin', 'password' => Hash::make('Drl3Sdk4'),  'livello' => 'admin','visibilita' => NULL,'descrizione'=>'Admin del sito', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'staff', 'cognome' => 'staff', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','02','01'), 'email' => 'staff.staff@blo.it', 'username' => ' staffstaff', 'password' => Hash::make('Drl3Sdk4'),  'livello' => 'staff','visibilita' => NULL,'descrizione'=>'membro staff', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'blog', 'cognome' => 'blog', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'blog.blog@blo.it', 'username' => 'blogblog', 'password' => Hash::make('Drl3Sdk4'),  'livello' => 'utente','visibilita' => 'pubblico','descrizione'=>'utente', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'Luigi111', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'luigi.luigi111@blo.it', 'username' => 'Luigi111', 'password' => Hash::make('Luigi111'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'Luigi222', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'luigi.luigi222@blo.it', 'username' => 'Luigi222', 'password' => Hash::make('Luigi222'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'Luigi333', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'luigi.luigi333@blo.it', 'username' => 'Luigi333', 'password' => Hash::make('Luigi333'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'Luigi444', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'luigi.luigi444@blo.it', 'username' => 'Luigi444', 'password' => Hash::make('Luigi444'), 'visibilita' => "privato", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'Luigi555', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'luigi.luigi555@blo.it', 'username' => 'Luigi555', 'password' => Hash::make('Luigi555'), 'visibilita' => "privato", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo111', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo111@blo.it', 'username' => 'pippo111', 'password' => Hash::make('pippo111'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo222', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo222@blo.it', 'username' => 'pippo222', 'password' => Hash::make('pippo222'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo333', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo333@blo.it', 'username' => 'pippo333', 'password' => Hash::make('pippo333'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo444', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo444@blo.it', 'username' => 'pippo444', 'password' => Hash::make('pippo444'), 'visibilita' => "pubblico", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo555', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo555@blo.it', 'username' => 'pippo555', 'password' => Hash::make('pippo555'), 'visibilita' => "privato", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo666', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo666@blo.it', 'username' => 'pippo666', 'password' => Hash::make('pippo666'), 'visibilita' => "privato", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['foto_profilo' => NULL, 'name' => 'pippo777', 'cognome' => 'Rossi', 'sesso' => 'Maschio', 'data_nascita' => Carbon::create('2000','03','01'), 'email' => 'pippo.pippo777@blo.it', 'username' => 'pippo777', 'password' => Hash::make('pippo777'), 'visibilita' => "privato", 'livello' => 'utente','descrizione'=>'ciao mondo del blog ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

        ]);


 DB::table('blogs')->insert([

            ['titolo'=>'Mio blog 1','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 3,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog 2 ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 3,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog 3 ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 3,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog 11 ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 5,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog 22 ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 5,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog 33 ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 5,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog prova ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 6,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog  bello','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 7,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog ciao ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 7,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog ciaoooo ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 8,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog prova ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 11,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog  bello','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 13,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog ciao ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 13,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['titolo'=>'Mio blog ciaoooo ','descrizione' => 'blog super accatturante e interessante ', 'utente_proprietario' => 15,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
     ]);



   DB::table('post')->insert([

       ['blog'=>1,'scrittore'=>'blogblog','contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
       ['blog'=>1,'scrittore'=>'Luigi111','contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
       ['blog'=>1,'scrittore'=>'Luigi222','contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
       ['blog'=>1,'scrittore'=>'pippo222','contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
       ['blog'=>11,'scrittore'=>11,'contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
       ['blog'=>11,'scrittore'=>3,'contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
       ['blog'=>11,'scrittore'=>12,'contenuto' => 'ecco qui il mio post ','data' => Carbon::create('2022','06','02'),'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
     ]);




DB::table('amici')->insert([

            ['utente_riferimento' => 3, 'amico_utente_riferimento' =>4,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['utente_riferimento' => 3, 'amico_utente_riferimento' =>5,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['utente_riferimento' => 10, 'amico_utente_riferimento' =>3,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['utente_riferimento' => 11, 'amico_utente_riferimento' =>3,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],
            ['utente_riferimento' => 11, 'amico_utente_riferimento' =>12,'created_at' => Carbon::create('2022','06','02'), 'updated_at' => Carbon::create('2022','06','02')],

        ]);

DB::table('richieste')->insert([
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 2  , 'richiedente'=>  4, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 2  , 'richiedente'=>  5, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 2  , 'richiedente'=>  3, 'accettante'=>10],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 2  , 'richiedente'=>  3, 'accettante'=>11],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 2  , 'richiedente'=>  12, 'accettante'=>11],

            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 1  , 'richiedente'=>  7, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 1  , 'richiedente'=>  8, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 1  , 'richiedente'=>  12, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 1  , 'richiedente'=>  14, 'accettante'=>3],

            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 0  , 'richiedente'=>  6, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 0  , 'richiedente'=>  9, 'accettante'=>3],
            ['data_richiesta' => Carbon::create('2022','06','02'), 'data_risposta'=> Carbon::create('2022','06','04') ,  'stato'=> 0  , 'richiedente'=>  13, 'accettante'=>3],

     ]);


    DB::table('messaggi')->insert([

        ['contenuto' => 'Ciao ho appena accettato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','00') , 'mittente' => 3 , 'destinatario' => 4,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],
        ['contenuto' => 'Ciao ho appena accettato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','01') , 'mittente' => 3 , 'destinatario' => 5,'created_at' => Carbon::create('2022','06','02','19','30','00'), 'updated_at' => Carbon::create('2022','06','02','19','30','00')],
        ['contenuto' => 'Ciao ho appena accettato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','02') , 'mittente' => 10 , 'destinatario' => 3,'created_at' => Carbon::create('2022','06','02','19','30','00'), 'updated_at' => Carbon::create('2022','06','02','19','30','00')],
        ['contenuto' => 'Ciao ho appena accettato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','03') , 'mittente' => 11 , 'destinatario' => 3,'created_at' => Carbon::create('2022','06','02','19','30','00'), 'updated_at' => Carbon::create('2022','06','02','19','30','00')],
        ['contenuto' => 'Ciao ho appena accettato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','04') , 'mittente' => 11 , 'destinatario' => 12,'created_at' => Carbon::create('2022','06','02','19','30','00'), 'updated_at' => Carbon::create('2022','06','02','19','30','00')],

        ['contenuto' => 'Ciao ho appena rifiutato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','05') , 'mittente' => 3 , 'destinatario' => 6,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],
        ['contenuto' => 'Ciao ho appena rifiutato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','06') , 'mittente' => 3 , 'destinatario' => 9,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],
        ['contenuto' => 'Ciao ho appena rifiutato la tua richiesta di amicizia ' , 'data' => Carbon::create('2022','06','02','19','30','07') , 'mittente' => 3 , 'destinatario' => 13,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],

        ['contenuto' => 'Ciao ti ho appena inviato una richiesta di amicizia  ' , 'data' => Carbon::create('2022','06','02','19','30','00') , 'mittente' => 7 , 'destinatario' => 3,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],
        ['contenuto' => 'Ciao ti ho appena inviato una richiesta di amicizia  ' , 'data' => Carbon::create('2022','06','02','19','30','00') , 'mittente' => 8 , 'destinatario' => 3,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],
        ['contenuto' => 'Ciao ti ho appena inviato una richiesta di amicizia  ' , 'data' => Carbon::create('2022','06','02','19','30','00') , 'mittente' => 12 , 'destinatario' => 3,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],
        ['contenuto' => 'Ciao ti ho appena inviato una richiesta di amicizia  ' , 'data' => Carbon::create('2022','06','02','19','30','00') , 'mittente' => 14 , 'destinatario' => 3,'created_at' => Carbon::create('2022','06','01'), 'updated_at' => Carbon::create('2022','06','01')],

        ]);
//riportiamo solo messaggi relativi a richieste e amicizie
//non ci sono messaggi notifica per creazione/eliminazione di  blog/post

    }//chiude funzione

}//chiude seeder
