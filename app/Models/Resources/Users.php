<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['foto_profilo' ,'name','cognome','sesso','data_nascita','email','username','password','livello','descrizione'];

public function memorizzastaff (array $data)
     {


       return User::create([
            'foto_profilo' => NULL,
            'name' => $data['name'],
            'cognome' => $data['cognome'],
            'sesso' => $data['sesso'],
            'data_nascita' => $data['data_nascita'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
             'livello' => $data['livello'],
             'descrizione' => $data['descrizione']
        ]);

    }




}
