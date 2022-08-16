<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// scrivo variabili e dati che mi servono da altri models
use App\Models\Resources\Post;
use App\Models\Resources\Users;



//prima era blog con b
class Blog extends Model
{

     protected $table = 'blogs';
    protected $primaryKey = 'id';


      // questa funzione mi ritorna le informazioni sul blog di un certo utente che lo individua tramite id
    public function getblogsofuser($id) {
$blog=Blog::where("utente_proprietario",$id)->select( "titolo","descrizione","utente_proprietario")->get();
 return $blog;
    }

//questa sotto chiude la classe che estende il model
}
