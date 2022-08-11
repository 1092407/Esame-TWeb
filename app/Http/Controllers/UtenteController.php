<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtenteController extends Controller
{
public function __construct(){
        $this->middleware('can:isUtente');

    }

    public function indexutente()
    {
        return view('homeutente');  // mi fa aprire home utente
    }
}
