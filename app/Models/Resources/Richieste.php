<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Richieste extends Model {     // moficiata, fare attenzione a accettante e richiedente su $fillable

    protected $table = 'richieste';
    protected $primaryKey = 'id';
    protected $fillable=['data_richiesta','data_risposta','stato','richiedente','accettante'];
    public $timestamps = false; #Ci consente di evitare che vengano aggiunte le due colonne per tracciare la data di inserimento equella di ultima modifica
}
  //modificato
   // le variabili dentro $fillable mi sono quelle che uso per creare dei record nel db
