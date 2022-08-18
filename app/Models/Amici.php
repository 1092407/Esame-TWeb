<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Resources\Users;
 // non dovrebbe servirmi use App\Models\Resources\Richieste;


class Amici extends Model
{
    protected $table = 'amici';
    protected $primaryKey = 'id';


/*  potrebbe non servirmi qui
    // mi ritorna gli id degli amici di un certo utente che scelgo per id (quello passato come parametro alla funzione )
    //poi in qualche modo dagli id degli amici devo risalire ai nomi e cognomi
     public function getamiciofuser($id) {
$amico=Amici::where("utente_riferimento",$id)->select( "amico_utente_riferimento")->get();
 return $amico;
    }

*/

//chiude la classe che estende model
}
