<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Utente extends Controller
{
public function __construct(){
        $this->middleware('can:isUtente');

    }

    public function index(){
        return view('homeutente');
    }
}

