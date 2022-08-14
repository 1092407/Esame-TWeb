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



public function getThisstaff($id){
        $staff = Users::find($id);
        return $staff;
    }

/*
public function getThisstaff($id){  // mi recupera dati su un solo membro dello staff grazie al suo id

        $staff=Users::where("livello","staff")->where("id",$id)->select( "id","name","cognome","sesso","data_nascita","email","username","descrizione")->get();
        return $staff;
    }
*/




/////
}
