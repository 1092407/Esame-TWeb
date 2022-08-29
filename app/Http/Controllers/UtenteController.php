<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Http\Requests\NewBlogRequest;
use App\Http\Requests\NewPostRequest;

use App\Models\Resources\Users;
use App\Models\Blog;
use App\Models\Amici;
use App\Models\Resources\Post;
use App\Models\Messaggistica;


use Illuminate\Support\Facades\File;
use Carbon\Carbon;




class UtenteController extends Controller
{

protected $usersmodel;
protected $blogmodel;
protected $amicimodel;
protected $postmodel;
protected $messaggisticamodel;

public function __construct(){
        $this->middleware('can:isUtente');
        $this->usersmodel = new Users;
         $this->blogsmodel = new Blog;
          $this->amicimodel = new Amici;
           $this->postmodel = new Post;
            $this->messaggisticamodel = new Messaggistica;
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




   // mi fa vedere i miei blog
     public function showmyblogs(){

     $id=auth()->user()->id;

     $blogs = $this->usersmodel->getmyblogs($id);
     return view('mioblog')
       ->with('blogs',$blogs);
     }



    public function creablog(){  //mi porta alla view con la form per registrare un nuovo blog
   return view('nuovoblog');
    }

   // mi serve per creare un nuovo blog
    public function storeblog(NewBlogRequest $request){      // DA MODIFICARE PERCHE CAMBIA POI LA MIGRATION RELATIVA A BLOG
        $blog= new Blog;
        $blog->fill($request->validated());

     $utenteproprietario=auth()->user()->id;
     $blog['utente_proprietario']=$utenteproprietario;

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
    }


//per vedere i miei amici dalla mia area riservata
     public function showmyfriends(){
        $id=auth()->user()->id;
        $amici = $this->usersmodel->getmyfriendLEFT($id); //left
        $amiciright=$this->usersmodel->getmyfriendRIGHT($id);

        return view('mioamico')
                ->with('amici',$amici)->with('amiciright',$amiciright);
     }


   public function deletemyfriendLEFT($amico)
    {
    $id=auth()->user()->id; // mi serve come riferimento nelle query per eliminare

      // ora non devo eliminare righe dalla tabella users ma dalla tabella amici dove sono memorizzate le relazioni di amicizia

        $amicoeliminato=Amici::where("utente_riferimento",$id)->where("amico_utente_riferimento",$amico)->first();

        $amicoeliminato->delete();

        return  redirect()->route('amici')
                 ->with('status', 'amico eliminato correttamente!');


    }


   public function deletemyfriendRIGHT($amicoright)
    {
     $id=auth()->user()->id; // mi serve come riferimento nelle query per eliminare

      // ora non devo eliminare righe dalla tabella users ma dalla tabella amici dove sono memorizzate le relazioni di amicizia

        $amicoeliminatoright=Amici::where("amico_utente_riferimento",$id)->where("utente_riferimento",$amicoright)->first();

        $amicoeliminatoright->delete();


        return  redirect()->route('amici')
                 ->with('status', 'amico eliminato correttamente!');
    }


//questa mi fa vedere un MIO BLOG
  public function showthisblog($id){ // id del blog
     $blog=Blog::where("id",$id)->first();
      $posts=Post::where ("blog",$id)->get();
     return view('vedi_questo_blog')
         ->with('blog',$blog)->with('posts',$posts);
     }


 public function storepost(NewPostRequest $request,$id){      // $id è del blog su cui posto
        $post= new Post;
        $post->fill($request->validated());
        $post['blog']=$id;

        $usernameloggato=auth()->user()->username;
        $post['scrittore']=$usernameloggato;
        $post['data']= Carbon::now();

        $post->save();

        return redirect()->route('questoblog',$id)
            ->with('status', 'Post aggiunto correttamente!');
    }




public function showamicoblog($id ){  //$id è id del blog che voglio vedere
                                         //è come quella per vedere un mio blog
   $blog=Blog::where("id",$id)->first();
   $posts=Post::where ("blog",$id)->get();
   return view('vedi_questo_blog')
         ->with('blog',$blog)->with('posts',$posts);
}

// fin qui ok


//questa mi ritorna le varie chat nella colonna a sx della view per visualizzare i _messaggisticaModel

 public function showMessaggi()
    {
        $chat = $this->messaggisticamodel->getChat(auth()->user()->id);

        return view("messaggi")
            ->with('chat', $chat);
    }


// mi mostra la conversazione con un certo destinatario
public function showChat( $destinatario)
    {
        $chat = $this->messaggisticamodel->getChat(auth()->user()->id);  //mi serve per mantenere a sx la lista delle chat anche se ne apro una a dx
        $messaggi = $this->messaggisticamodel->getConversazione(auth()->user()->id, $destinatario);

        return view("messaggi")
            ->with('chat', $chat)
            ->with('messaggi', $messaggi)
            ->with('id', auth()->user()->id);
    }



// chiude il controller
}
