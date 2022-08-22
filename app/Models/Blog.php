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


protected $fillable = ['titolo','descrizione']; // campi che posso far inserire


      // questa funzione mi ritorna le informazioni sul blog di un certo utente che lo individua tramite id
    public function getblogsofuser($id) {
$blog=Blog::where("utente_proprietario",$id)->select( "titolo","descrizione","utente_proprietario")->get();
 return $blog;
    }  //la uso in admin controller

    //FIN QUI TUTTO BENE




//per prendere un determinato blog tramite il suo id
 public function getthisblog($id){
    $blog=Blog::where("id",$id)->select( "id","titolo","descrizione")->first();
   return $blog;
    }

//questa sotto chiude la classe che estende il model
}
