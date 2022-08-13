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



    public function __construct(){
        $this->middleware('can:isAdmin');

    }

    public function index(){
        return view('statistiche');
    }

    public function mettistaff(){
        return view('registrastaff');
    }

////funzionava

    public function storestaff(NewstaffRequest $request){      // mi serve per inserire un nuovo membro dello staff
        $staff= new Users;
        $staff->fill($request->validated());
      //  $staff->save();  //cosi va bene perche lo registra nel db, ma poi non cripta password e il login non ha successo

       $appoggio1=$staff['password'];        // devo utilizzare questo vecchio trucchetto per criptare la
        $appoggio2=Hash::make($appoggio1);    // password affinchè poi il login abbia successo
        $staff['password']=$appoggio2;        // per il nuovo membro staff che crea admin
        $staff->save();

        return redirect()->route('admin')
            ->with('status', 'Membro staff inserito correttamente!');
    }


   /* public function showStatistiche(Request $request){

        request()->validate([
           'fine_intervallo' =>[new GreaterThan($request->inizio_intervallo)]
        ]);
        $statistiche= $this->_catalogModel->getStatistiche($request->inizio_intervallo,$request->fine_intervallo,$request->tipo_camera);
        $filtri[0]=$request->inizio_intervallo;
        $filtri[1]=$request->fine_intervallo;
        $filtri[2]=$request->tipo_camera;
        return view('statistiche')
            ->with('richieste',[$statistiche[0],$statistiche[1],$statistiche[2]])
            ->with('locazioni',$statistiche[3])
            ->with('alloggi',$statistiche[4])
            ->with('filtri',$filtri);
    }

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

    public function storeFaq(NewFaqRequest $request){
        $faq= new Faq;
        $faq->fill($request->validated());
        $faq->save();

        return redirect()->route('faqindex')
            ->with('status', 'Faq inserita correttamente!');
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
