<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';

    // questo mi serve per far inserire all'admin i membri dello staff direttamete dalla sua area riservata
    protected $fillable = ['name','cognome','sesso','data_nascita','email','username','password','livello','descrizione'];



public function getstaff(){  // mi recupera info su TUTTI i  membri dello staff
        $staffs=Users::where("livello","staff")->select( "id","name","cognome","sesso","data_nascita","email","username","descrizione")->get();
        return $staffs;
    }



// questa va bene per eliminare e modificare  un membro dello staff quindi NON MODIFICARE

public function getThisstaff($id){  // mi recupera dati su un solo membro dello staff grazie al suo id

  $staff=Users::where("livello","staff")->where("id",$id)->select( "id","name","cognome","sesso","data_nascita","email","username","descrizione")->first();

   return $staff;
    }  // NON MODIFICARE
//FIN QUI TUTTO BENE








//INIZIO fne
public function getThis($id){
//variabili di appoggio
  $app1 = Users::where("id",$id)->select( "id")->first();  // se metto get () non riceve id nella form nella view
        $app2 = Users::where("id",$id)->select( "name")->first();   // su questi se metto get o first non cambia per output
        $app3 = Users::where("id",$id)->select( "cognome")->first();
        $app4 = Users::where("id",$id)->select( "sesso")->first();
        $app5 = Users::where("id",$id)->select( "data_nascita")->first();
        $app6 = Users::where("id",$id)->select( "email")->first();
        $app7 = Users::where("id",$id)->select( "username")->first();
        $app8 = Users::where("id",$id)->select( "descrizione")->first();

$staff=[$app1,$app2,$app3,$app4,$app5,$app6,$app7,$app8];
// questo è un array asscociativo e cosi non va bene perche poi nella view mi stampa chiave e valore
// mentre a me interessa solo il valore da mettere a schermo



        return $staff;
 } // FINE fne







//PROVEEEEEEEEE



/*

queste sono pezi per provare a estarrre solo i valori

foreach($array as $key => $value)
{
   echo $key." is ". $value;
}


$data='IL TUO ARRAY NON DIMENTICARLO';
$m_data=[];
$intestazioni=array_keys($data[0]);
foreach ($data as $k=>$v){
   foreach ($intestazioni as $items)(!isset($m_data[$items]))?$m_data[$items]=$v[$items]:$m_data[$items].=','.$v[$items];
}
extract($m_data);

<?php
$fruites = array('apple', 'banana', 'orange');
echo implode(',',$fruites);   // stampa apple,banana,orange
?>



 MIA PROVA
$app=[$app1,$app2,$app3,$app4,$app5,$app6,$app7,$app8,];  // coppie che prende dalle query
$staff=[];  // array che voglio ritornare e che voglio contenga SOLO i valori di $app

$intestazioni=array_keys($app[]);
foreach ($app as $k=>$v){
   foreach ($intestazioni as $items)(!isset($staff[$items]))?$staff[$items]=$v[$items]:$staff[$items].=','.$v[$items];
}
extract($staff);


pezzi prova
*/

// questa sotto funziona
/*
public function getThis($id){
        $staff = Users::where("id",$id)->select( "id")->first();
        return $staff;
    }
*/


///// è la parentesi che chiude estensione del model
}
