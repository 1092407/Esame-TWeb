<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests\NewBlogRequest;

use App\Models\Resources\Users;
use App\Models\Blog;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;




class UtenteController extends Controller
{

protected $usersmodel;
protected $blogmodel;

public function __construct(){
        $this->middleware('can:isUtente');
        $this->usersmodel = new Users;
         $this->blogsmodel = new Blog;

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
            'password' => 'string|min:8',
            'descrizione' => 'string|max:2500'
        ]);

        //  'string|min:8|'


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





     public function showmyblogs(){

     $id=auth()->user()->id;

     $blogs = $this->usersmodel->getmyblogs($id);
     return view('mioblog')
    ->with('blogs',$blogs);
     }

    public function creablog(){  //mi porta alla view con la form per registrare un nuovo blog
   return view('nuovoblog');
    }





    public function storeblog(NewBlogRequest $request){      // mi serve per creare un nuovo blog
        $blog= new Blog;
        $blog->fill($request->validated());

     $utenteproprietario=auth()->user()->id;
     $blog['utente_proprietario']=$utenteproprietario;

     $amico=5;
     $blog['amico_proprietario']=$amico; // ora lo metto perche mi serve per test, ma poi devo eliminare dal db questa colonna perche non serve


        $blog->save();

        return redirect()->route('mioblog')
            ->with('status', 'Blog creato correttamente!');
    }




// per eliminare un blog a scelta dell'utente
public function deletemyblog($id)
    {
      $blog=Blog::where("id",$id)->first();
        $blog->delete();

        return  redirect()->route('mioblog')
            ->with('status', 'blog eliminato correttamente!');
    }//funziona non modificare



//FIN QUI TUTTO BENE


     public function showmyfriends(){

     $id=auth()->user()->id;

       $amici = $this->usersmodel->getamiciofuserLEFT($id);

         $amiciright=$this->usersmodel->getamiciofuserRIGHT($id);

        return view('mioamico')
                ->with('amici',$amici)->with('amiciright',$amiciright);


     }







// chiude il controller
}
