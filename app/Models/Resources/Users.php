<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Amici;

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

//FIN QUI TUTTO BENE










/*

// questa voglio che mi recupera nome cognome e username degli amici di un certo utente che passo come parametro con il suo id
// problema è scrivere la query fatta bene
  public function getamiciofuser($id) {

     $amico=Users:: select ("name","cognome","username")->where("id","=" ,function($query)  {

      $query=Amici::where("utente_riferimento",$id )->select( "amico_utente_riferimento");

      })->get();


 return $amico;
    }

    */

  /*  in SQL SAREBBE

  SELECT( name,cognome,username)
  FROM users
  where id=   (
                select amico_utente_riferimento
                from amici
                where utente_riferimento=$id

             )
   la devo fare con il query builder di laravel
  */

 //mi prende info di un detrminato user
public function finduserbyid($id){
$user=Users:: where('id','=',$id)->select( "id","name","cognome","username")->fisrt();
return $user;
}

public function getamiciofuserLEFT($id) {

 $idamici= Amici::where('utente_riferimento','=',$id)->select("amico_utente_riferimento")->get()->toArray();

    for($i=0;$i<count($idamici);$i++){
            $app1= Users:: where('id','=',$idamici[$i])->value( "name");
            $app2= Users:: where('id','=',$idamici[$i])->value( "cognome");
            $app3= Users:: where('id','=',$idamici[$i])->value( "username");
             $amico[$i]=[$app1,$app2,$app3];
        }



    return $amico ;
    }

 public function getamiciofuserRIGHT($id) {

 $idamici= Amici::where('amico_utente_riferimento','=',$id)->select("utente_riferimento")->get()->toArray();

    for($i=0;$i<count($idamici);$i++){
            $app1= Users:: where('id','=',$idamici[$i])->value( "name");
            $app2= Users:: where('id','=',$idamici[$i])->value( "cognome");
            $app3= Users:: where('id','=',$idamici[$i])->value( "username");
             $amicoright[$i]=[$app1,$app2,$app3];
        }

    return $amicoright ;
    }




/*


 public function getLocatarioRichieste($id){
        $richieste= Richieste::where('locatario','=',$id)->get();
        for($i=0;$i<count($richieste);$i++){
            $richieste[$i] = Richieste::join('alloggi','richieste.id_alloggio','=','alloggi.id')->where('richieste.id','=',$richieste[$i]->id)->select('richieste.id','richieste.id_alloggio','richieste.data_richiesta','richieste.data_risposta','richieste.stato','alloggi.titolo','alloggi.prezzo','alloggi.tipologia','alloggi.periodo_locazione')->get();
        }
        return $richieste;

    }





 $alloggi = Alloggi::where(function($alloggio) use ($citta){
            $alloggio->where('citta','LIKE','%'.$citta.'%')
                    ->oRwhere('regione','LIKE','%'.$citta.'%');
        });



public function checkDisponibilityByDate(Request $req)
{
    $fecha = $req->fecha;

    $vehiculos= Vehiculo::join('Reservaciones', 'Vehiculos.id', '=', 'Reservaciones.id_vehiculo')
                ->join('Marcas', 'Vehiculos.id_marca', '=' , 'Marcas.id')
                ->join('Modelo', 'Vehiculos.id_modelo', '=' , 'Modelo.id')
                ->select('Marcas.nombre as Marca', 'Modelo.nombre as Modelo', 'Vehiculos.year as Anio', 'Vehiculos.id')
                ->where('Vehiculos.id_marca', '=' ,$req->id_marca)
                ->where('Marcas.id_categoria', '=' ,$req->id_categoria)
                ->whereNotIn('Vehiculos.id', function($query) use ($fecha) {
                    $query->select('id_vehiculo')
                          ->from('Reservaciones')
                          ->where('fecha', '=', $fecha);
            })
            ->get();
    return $vehiculos->toJson();





$alloggi_filtri = Alloggi::leftJoin('incluso','incluso.alloggio','=','alloggi.id');



        $alloggi = Alloggi::where(function($alloggio) use ($citta){
            $alloggio->where('citta','LIKE','%'.$citta.'%')
                    ->oRwhere('regione','LIKE','%'.$citta.'%');
        });


     $amico =Users::select ("name","cognome","username")->where("id","=" ,function($query) use ($id){

     $query=Amici::where("utente_riferimento",$id )->select( "amico_utente_riferimento")->get();
     })->get();

    return $amico ;
    }




*/


///// è la parentesi che chiude estensione del model
}
