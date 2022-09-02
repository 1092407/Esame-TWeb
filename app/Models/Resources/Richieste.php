<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Users;

class Richieste extends Model {     // moficiata, fare attenzione a accettante e richiedente su $fillable

    protected $table = 'richieste';
    protected $primaryKey = 'id';
    protected $fillable=['data_richiesta','data_risposta','stato','richiedente','accettante'];
    public $timestamps = false; #Ci consente di evitare che vengano aggiunte le due colonne per tracciare la data di inserimento equella di ultima modifica



// per un certo utente,che passo per id , voglio tutte le richieste e quelle che ha acettato

public function getrichiesteofuser($id){
 $totali=Richieste::where("accettante",$id)->count();  // mi conta TUTTE le richieste arrivate
$accettate=Richieste::where("accettante",$id)->where("stato","1")->count();   //mi conta solo  quelle accetate,cioè con stato settato=1. Scritto anche nella migration richieste che descrive la struttura dati
 return [$totali,$accettate];  // cosi faccio in modo che mi torni un array, altrimenti puo dare problemi e dirmi che lavoro con oggetti o collezioni mentre vorrei un array sulle operazioni che faccio su admin controller e view statistiche richieste
    }

    //fin qui ok

   public function getRichiesta($id){
        $richiesta= Richieste::find($id);
        return $richiesta;
    }



//questa funzione permette all'utente loggato di vedere le richieste che puo accettatre o rifiutare

public function getAmiciziaRichieste(){
      $id=auth()->user()->id;

        $richieste_amicizia = Richieste::join('users','richieste.richiedente','=','users.id')
            ->where('richieste.accettante', $id)
            ->where('stato','=',1)   //cioè quelle in attesa
            ->select('richieste.id','richieste.data_richiesta','richieste.stato','richieste.richiedente','richieste.accettante','users.name','users.cognome','users.username','users.descrizione','users.foto_profilo','users.cellulare')
            ->get();
        return $richieste_amicizia;
    }



/*
public function getAlloggioRichieste($id_alloggio){
        $richieste_alloggio = Richieste::join('users','richieste.locatario','=','users.id')
            ->where('richieste.id_alloggio', $id_alloggio)
            ->where('stato','=',1)
            ->select('richieste.id','richieste.data_richiesta','richieste.stato','richieste.locatario','richieste.id_alloggio','users.name','users.cognome','users.sesso','users.data_nascita','users.email','users.cellulare')
            ->get();
        return $richieste_alloggio;
    }

*/

// questa chiude l'estensione del model
}

