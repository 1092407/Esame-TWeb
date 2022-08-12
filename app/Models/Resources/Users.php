<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['foto_profilo' ,'name','cognome','sesso','data_nascita','email','username','password','livello','descrizione'];
}
