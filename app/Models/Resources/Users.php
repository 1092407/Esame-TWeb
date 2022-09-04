<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Amici;
use App\Models\Blog;


class Users extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';

    // questo mi serve per far inserire all'admin i membri dello staff direttamete dalla sua area riservata
 protected $fillable = ['name','cognome','sesso','data_nascita','email','username','password','livello','descrizione'];



public function getusers(){  // mi recupera info su TUTTI i  gli utenti del sito
  $users=Users::where("livello","utente")->select( "id","name","cognome","sesso","data_nascita","email","username","descrizione")->get();
        return $users;
    }





public function getstaff(){  // mi recupera info su TUTTI i  membri dello staff
        $staffs=Users::where("livello","staff")->select( "id","name","cognome","sesso","data_nascita","email","username","descrizione")->get();
        return $staffs;
    }

// questa va bene per eliminare e modificare  un membro dello staff quindi NON MODIFICARE

public function getThisstaff($id){  // mi recupera dati su un solo membro dello staff grazie al suo id

  $staff=Users::where("livello","staff")->where("id",$id)->select( "id","name","cognome","sesso","data_nascita","email","username","descrizione")->first();

   return $staff;
    }




public function getThis($id){
//variabili di appoggio che uso per query facili e veloci
  $app1 = Users::where("id",$id)->value( "id");
        $app2 = Users::where("id",$id)->value( 'name');
        $app3 = Users::where("id",$id)->value( "cognome");
        $app4 = Users::where("id",$id)->value( "sesso");
        $app5 = Users::where("id",$id)->value( "data_nascita");
        $app6 = Users::where("id",$id)->value( "email");
        $app7 = Users::where("id",$id)->value( "username");
       $app8 = Users::where("id",$id)->value( "descrizione");

$staff=[$app1,$app2,$app3,$app4,$app5,$app6,$app7,$app8];

        return $staff;
 }



 //mi prende info di un detrminato user
public function finduserbyid($id){
$user=Users:: where('id','=',$id)->select( "id","name","cognome","username")->fisrt();
return $user;
}



/*
 QUESTE DUE FUNZIONI CHE SEGUONO  SERVONO PER AVERE GLI AMICI DI UN DATO UTENTE

USO DUE FUNZIONI, UNA 'LEFT' E UNA 'RIGHT' IN BASE A QUALE COLONNA NELLA TABELLA 'AMICI' DEL DB
DI TROVA $id CHE PASSO COME PARAMETRO

SEGUE SPIEGAZIONE CON ESMPIO
VOGLIO TROVARE GLI AMICI DI a E ATTUALMENTE LA TABELLA CHE HO E' LA SEGUENTE
le lettere a b c d f in questo caso faccio finta siano gli id degli utenti


LA TABELLA                  utente_riferimento         amico_utente_riferimento
                                     a                             b
                                     a                              c
                                     a                              d
                                     f                              a



     PER LOGICA E COME ANCHE INDICATO NELLE SPECIFICHE GLI AMICI DI a SONO 4 , OVVERO b c d f
     SE ANDASSI A CERCARE IN UNA SOLA DELLE DUE COLONNE POTREI PERDERMI DEGLI AMICI(IN QUESTO CASO ASSOLUTAMENTE SI, MA IN ALTRI NO) E NON POSSO PERMETTERMI UN ERRORE SIMILE

     CON LA FUNZIONE 'LEFT' DICO CHE IL PARAMETRO è NELLA COLNNA UTENTE RIFERIMENTO
     CON LA FUNZIONE 'RIGHT ' INVECE NELL'ALTRA

     SOLO FACENDO QUESTA DOPPIA SCANSIONE SONO SICURO AL 100% DI RECUPERARE TUTTI GLI AMICI DI a

*/


public function getamiciofuserLEFT($id) {

 $idamici= Amici::where('utente_riferimento','=',$id)->select("amico_utente_riferimento")->get()->toArray();

$check=count($idamici);

if($check==0){
$amico=['   '];   // se è vuota non gli faccio stampare nulla perchè questa è una stringa di tre spazi tra le ''
}

if(($check!=0)) {
    for($i=0;$i<count($idamici);$i++){
            $app1= Users:: where('id','=',$idamici[$i])->value( "name");
            $app2= Users:: where('id','=',$idamici[$i])->value( "cognome");
            $app3= Users:: where('id','=',$idamici[$i])->value( "username");

             $amico[$i]=[$app1,$app2,$app3];
        }
    }
           return $amico;
    }



 public function getamiciofuserRIGHT($id) {

 $idamici= Amici::where('amico_utente_riferimento','=',$id)->select("utente_riferimento")->get()->toArray();


$check=count($idamici);

if($check==0){
$amicoright=['   '];   // se è vuota non gli faccio stampare nulla
}


if(($check!=0)) {
    for($i=0;$i<count($idamici);$i++){
            $app1= Users:: where('id','=',$idamici[$i])->value( "name");
            $app2= Users:: where('id','=',$idamici[$i])->value( "cognome");
            $app3= Users:: where('id','=',$idamici[$i])->value( "username");
             $amicoright[$i]=[$app1,$app2,$app3];
        }
}
    return $amicoright ;
    }


//serve ad un certo utente per vedere i propri blogs dalla sua area riservata
public function getmyblogs($id){
$blogs=Blog::where("utente_proprietario",$id)->select("id","titolo","descrizione")->get();
return $blogs;
}



// FIN QUI OK NON MODIFICARE

/* questedue seguenti  simili a quelle precedenti dove pero sono specifiche per ogni utente quindi serve   $id=auth()->user()->id;

  inoltre con $amico e $amicoright devo recuperare ancche id dell'amico per passarlo alla rotta che me lo elimina
  perche io voglio eliminare un detrminato mio amico che ovviamente identifico tramite il suo id
  ma anche per vedere i blog del mio amico (se ne ha )
*/


public function getmyfriendLEFT($id) {

$id=auth()->user()->id;

 $idamici= Amici::where('utente_riferimento','=',$id)->select("amico_utente_riferimento")->get()->toArray();

$check=count($idamici);

if($check==0){
$amico=['     '];   // se è vuota non gli faccio stampare nulla perchè questa è una stringa di x
}                   // spazi tra le '' quante sono le $app seguenti (infatti stampo tre campi se non è vuota)

if(($check!=0)) {
    for($i=0;$i<count($idamici);$i++){
            $app1= Users:: where('id','=',$idamici[$i])->value( "name");
            $app2= Users:: where('id','=',$idamici[$i])->value( "cognome");
            $app3= Users:: where('id','=',$idamici[$i])->value( "username");
            $app4= Users:: where('id','=',$idamici[$i])->value( "id");    // questo poi mi serve come parametro da passare alle rotte
             $app5= Users:: where('id','=',$idamici[$i])->value( "foto_profilo");
            $amico[$i]=[$app1,$app2,$app3,$app4,$app5];
        }
    }//chiude if
           return $amico;
    }



 public function getmyfriendRIGHT($id) {

 $id=auth()->user()->id;

 $idamici= Amici::where('amico_utente_riferimento','=',$id)->select("utente_riferimento")->get()->toArray();


$check=count($idamici);

if($check==0){
$amicoright=['     '];   // se è vuota non gli faccio stampare nulla
}


if(($check!=0)) {
    for($i=0;$i<count($idamici);$i++){
            $app1= Users:: where('id','=',$idamici[$i])->value( "name");
            $app2= Users:: where('id','=',$idamici[$i])->value( "cognome");
            $app3= Users:: where('id','=',$idamici[$i])->value( "username");
            $app4= Users:: where('id','=',$idamici[$i])->value( "id");        // questo poi mi serve come parametro da passare alle rotte
              $app5= Users:: where('id','=',$idamici[$i])->value( "foto_profilo");
             $amicoright[$i]=[$app1,$app2,$app3,$app4,$app5];
        }
}//chiude if
    return $amicoright ;
    }








///// è la parentesi che chiude estensione del model
}
