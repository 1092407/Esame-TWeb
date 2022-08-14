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

   public $lista;   // mi serve per funzioni che gestiscono modifica ed eliminazione dei membri dello staff

    public function __construct(){
        $this->middleware('can:isAdmin');
        $this->lista = new Users;
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

// fino qui tutto ok
// qui mi serve per modificare ed eliminare un membro staff


/*
public function showstaff(){ // semplice funzione che mi mostra la view per visualizzare/eliminare/modificare lo staff


       $staffs=Users::where("livello","staff")->select("name","cognome","sesso","data_nascita","email","username","descrizione")->get();
        return view('gestionestaff')->with('staffs',$staffs);
    }  // questa va bene perchè mi mostra i dati che mi serve vedere ma non mi aiuta per altre funzioni--> devo cambiare metodo
*/

// da qui prove
// mie


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


///sue









   /*


    public function showFaq(){
        $faqs = $this->_catalogModel->getFaq();
        return view('admin_faq')
                ->with('faqs',$faqs);
    }

    public function updateFaq(Request $request,$id)
    {
        $data = $request->validate([
            'domanda' => 'required|string|max:190',
            'risposta' => 'required|string|max:190',
        ]);

        $faq = $this->_catalogModel->getThisFaq($id);
        $faq->update($data);

        return redirect()->route('faqindex')
            ->with('status', 'Faq aggiornata correttamente!');
    }



    public function showFaqToUpdate($id){
        $faq = $this->_catalogModel->getThisFaq($id);
        return view('modifica_faq')->with('faq', $faq);
    }

    public function deleteFaq($id)
    {
        $faq = $this->_catalogModel->getThisFaq($id);
        $faq->delete();

        return  redirect()->route('faqindex')
            ->with('status', 'FAQ eliminata correttamente!');
    }
  */

}
