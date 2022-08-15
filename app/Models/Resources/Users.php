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





public function getThis($id){
  $app1 = Users::where("id",$id)->select( "id")->first();  // se metto get () non riceve id nella form nella view
        $app2 = Users::where("id",$id)->select( "name")->get();
        $app3 = Users::where("id",$id)->select( "cognome")->first();
        $app4 = Users::where("id",$id)->select( "sesso")->first();
        $app5 = Users::where("id",$id)->select( "data_nascita")->first();
        $app6 = Users::where("id",$id)->select( "email")->first();
        $app7 = Users::where("id",$id)->select( "username")->first();
        $app8 = Users::where("id",$id)->select( "descrizione")->first();

$staff=[$app1,$app2,$app3,$app4,$app5,$app6,$app7,$app8,];
// questo è un array asscociativo e cosi non va bene perche poi nella view mi stampa chiave e valore
// mentre a me interessa solo il valore da mettere a schermo



        return $staff;

    }









// questa sotto funziona
/*
public function getThis($id){
        $staff = Users::where("id",$id)->select( "id")->first();
        return $staff;
    }
*/


///// è la parentesi che chiude estensione del model
}
