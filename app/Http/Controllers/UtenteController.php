<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


use Illuminate\Support\Facades\File;
use Carbon\Carbon;




class UtenteController extends Controller
{
public function __construct(){
        $this->middleware('can:isUtente');

    }

    public function indexutente()
    {
        return view('homeutente');  // mi fa aprire home utente
    }

     public function showProfilo()
    {
        return view('profiloutente');    // mi apre il profilo utente
    }



     public function updateProfilo(Request $request)
    {
        $data = $request->validate([
            'foto_profilo' => 'file|mimes:jpeg,png|max:5000',
            'name' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'sesso' => 'required|string',
            'data_nascita' => 'required|date',
            'email' => 'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/',
            'password' => 'string|min:8|',
            'descrizione' => 'string|max:2500'
        ]);


        if ($request->hasFile('foto_profilo')) {
            $image = $request->file('foto_profilo');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path() . '/img/foto_profilo';
            $oldImage = $destinationPath . '/' . auth()->user()->foto_profilo;
            File::delete($oldImage);
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = auth()->user()->foto_profilo;
        }

        $data['foto_profilo'] = $imageName;
        User::find(auth()->user()->id)->update($data);

        return redirect()->route('profilo')
            ->with('status', 'Profilo aggiornato correttamente!');
    }


}  // chiude il controller
