<?php

namespace App\Http\Controllers;

use App\Models\Admin;



use Illuminate\Http\Request;
use App\Rules\GreaterThan;
use App\Models\Resources\Users;
use App\Http\Requests\NewstaffRequest;
use Illuminate\Support\Facades\Redirect;

//queste due mi servono per la form di registrazione di un membro staff
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller{

   protected $lista;   // mi serve per funzioni che gestiscono modifica ed eliminazione dei membri dello staff
                        //la chiamo coi perche ho idea di recuperare lista di info su utenti
    public function __construct(){
        $this->middleware('can:isAdmin');
        $this->lista = new Users;   // creo istanza di users per chiamre delle funzioni piu avanti per gestire staff
    }

    public function index(){
        return view('statistiche');
    }

    public function mettistaff(){
        return view('registrastaff');
    }



    public function storestaff(NewstaffRequest $request){      // mi serve per inserire un nuovo membro dello staff
        $staff= new Users;
        $staff->fill($request->validated());
      //  $staff->save();  //cosi va bene perche lo registra nel db, ma poi non cripta password e il login non ha successo

       $appoggio1=$staff['password'];        // devo utilizzare questo vecchio trucchetto per criptare la
        $appoggio2=Hash::make($appoggio1);    // password affinchè poi il login abbia successo
        $staff['password']=$appoggio2;        // per il nuovo membro staff che crea admin con questa funzione
        $staff->save();

        return redirect()->route('admin')
            ->with('status', 'Membro staff inserito correttamente!');
    }





/*
public function showstaff(){ // semplice funzione che mi mostra la view per visualizzare/eliminare/modificare lo staff


       $staffs=Users::where("livello","staff")->select("name","cognome","sesso","data_nascita","email","username","descrizione")->get();
        return view('gestionestaff')->with('staffs',$staffs);
    }  // questa va bene perchè mi mostra i dati che mi serve vedere ma non mi aiuta per altre funzioni--> devo cambiare metodo
*/




// questa va bene
public function showstaff(){
        $staffs = $this->lista->getstaff();  // funzione definita in Users model e lanciata qui
        return view('gestionestaff')
                ->with('staffs',$staffs);
    }



public function deletestaff($id)
    {
        $staff = $this->lista->getThisstaff($id);
        $staff->delete();

        return  redirect()->route('gestiscistaff')
            ->with('status', 'membro staff eliminato correttamente!');
    }
 // fino qui ok



// prove per farla funzionare- va bene ma non mi recupera tutto
    public function showStaffToUpdate($id){

        $staff = $this->lista->getThis($id);
        return view('modifica_staff')
                ->with('staff',$staff);

    }



    public function updatestaff(Request $request,$id)
    {
        $data = $request->validate([   // qui da mettere i validatori per i dati che inserisco nella form di modifica
            'name' => [ 'sometimes','string', 'max:255'],
            'cognome' => ['sometimes', 'string', 'max:255'],
            'sesso' => [ 'sometimes','string'],
            'data_nascita' => [ 'sometimes','date','before:18 years ago'],
            'email' => [ 'sometimes','string',  'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/'],
            'username' => ['sometimes', 'string', 'min:8'],  // qui alla fine ho tolto  -->  , 'unique:users' prima di ]

              'descrizione' => ['sometimes', 'string']
        ]);

        $staff = $this->lista->getThisstaff($id);
        $staff->update($data);

        return redirect()->route('gestiscistaff')
            ->with('status', 'Dati membro staff aggiornati correttamente!');
    }















// questa chiude controller
}
