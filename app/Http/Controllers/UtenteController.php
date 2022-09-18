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
use App\Models\Resources\Messaggi;
use App\Models\Resources\Richieste;


use Illuminate\Support\Facades\File;
use Carbon\Carbon;




class UtenteController extends Controller
{

protected $usersmodel;
protected $blogmodel;
protected $amicimodel;
protected $postmodel;
protected $messaggisticamodel;
protected $richiestemodel;

public function __construct(){
        $this->middleware('can:isUtente');
        $this->usersmodel = new Users;
         $this->blogsmodel = new Blog;
          $this->amicimodel = new Amici;
           $this->postmodel = new Post;
            $this->messaggisticamodel = new Messaggistica;
            $this->richiestemodel= new Richieste;
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
            'visibilita' => 'string',
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
    public function storeblog(NewBlogRequest $request){
        $blog= new Blog;
        $blog->fill($request->validated());

     $utenteproprietario=auth()->user()->id;
     $blog['utente_proprietario']=$utenteproprietario;
     $nome=$blog['titolo'];
     $blog->save();

     //ora notifico in automatico a tutti i miei amici che ho creato questo blog
     $idamicileft= Amici::where('utente_riferimento','=',$utenteproprietario)->select("amico_utente_riferimento")->get()->toArray();
     $idamiciright= Amici::where('amico_utente_riferimento','=',$utenteproprietario)->select("utente_riferimento")->get()->toArray();

        $idleft=[];
        for($r=0;$r<count($idamicileft);$r++){
        $app=Users::where("id",$idamicileft[$r])->value("id");
        $idleft[$r]=$app;
        }
     //messaggi per amicileft
      for ($i=0;$i<count($idleft);$i++){
       $messaggioleft = new Messaggi([
            'contenuto' => "Ho appena creato il seguente blog: ".$nome.".Corri a vederlo! ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $idleft[$i]
        ]);
        $messaggioleft->save();
       }//fine for
        $idright=[];
        for($s=0;$s<count($idamiciright);$s++){
        $app2=Users::where("id",$idamiciright[$s])->value("id");
        $idright[$s]=$app2;
        }

      for ($j=0;$j<count($idright);$j++){
       $messaggioright = new Messaggi([
            'contenuto' => "Ho appena creato il seguente blog: ".$nome.".Corri a vederlo! ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $idright[$j]
        ]);
        $messaggioright->save();
        }//fine for

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

         $messaggio = new Messaggi([
            'contenuto' => "sei stato eliminato dal mio gruppo di amici ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $amico

        ]);

        $messaggio->save();
        return  redirect()->route('amici')
                 ->with('status', 'amico eliminato correttamente!');
    }


   public function deletemyfriendRIGHT($amicoright)
    {
     $id=auth()->user()->id; // mi serve come riferimento nelle query per eliminare

      // ora non devo eliminare righe dalla tabella users ma dalla tabella amici dove sono memorizzate le relazioni di amicizia

        $amicoeliminatoright=Amici::where("amico_utente_riferimento",$id)->where("utente_riferimento",$amicoright)->first();

        $amicoeliminatoright->delete();

    $messaggio = new Messaggi([
            'contenuto' => "sei stato eliminato dal mio gruppo di amici ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $amicoright

        ]);

        $messaggio->save();
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

//oltre a creare il post devo mandare un messaggio a tutti gli amici del proprietario del blog perchè sono tutti quelli che possono vedere il blog su cui sto attualmente postando
 public function storepost(NewPostRequest $request,$id){      // $id è del blog su cui posto
        $post= new Post;
        $post->fill($request->validated());
        $post['blog']=$id;

        $usernameloggato=auth()->user()->username;
        $post['scrittore']=$usernameloggato;
        $post['data']= Carbon::now();
        $post->save();

         $nomeblog=Blog::where("id",$id)->value("titolo");

        //ora cerco di creare i messaggi da mandare
        $app1=Blog::where("id",$id)->value("utente_proprietario");  //è id del proprietario del blog: a tutti i suoi amici devo mandare messaggio perchè ho postato sul suo blog

        $proprietarioblog=Users::where("id",$app1)->value("username");

        //devo prendere gli id degli amici di $app1 perchè sono i destinatari dei miei messaggi di notifica

        $idamicileft= Amici::where('utente_riferimento','=',$app1)->select("amico_utente_riferimento")->get()->toArray();
        $idamiciright= Amici::where('amico_utente_riferimento','=',$app1)->select("utente_riferimento")->get()->toArray();

        $idleft=[];
        for($r=0;$r<count($idamicileft);$r++){
        $app=Users::where("id",$idamicileft[$r])->value("id");
        $idleft[$r]=$app;
        }

     //messaggi per amicileft
      for ($i=0;$i<count($idleft);$i++){
       $messaggioleft = new Messaggi([
            'contenuto' => "Ho appena postato sul blog ".$nomeblog." di ".$proprietarioblog.".Corri a vederlo! ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $idleft[$i]
        ]);
        $messaggioleft->save();
      }//fine for

        //ora identico ma per amiciright
       $idright=[];
        for($s=0;$s<count($idamiciright);$s++){
        $app2=Users::where("id",$idamiciright[$s])->value("id");
        $idright[$s]=$app2;
        }

      for ($j=0;$j<count($idright);$j++){

       $messaggioright = new Messaggi([
            'contenuto' => "Ho appena postato sul blog ".$nomeblog." di ".$proprietarioblog.".Corri a vederlo! ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $idright[$j]
        ]);
        $messaggioright->save();
      }//fine for

        return redirect()->route('questoblog',$id)
            ->with('status', 'Post aggiunto correttamente!');
    }



//mi fa vedere un blog una volta che lo seleziono
public function showamicoblog($id){  //$id è id del blog che voglio vedere
                                         //è come quella per vedere un mio blog
   $blog=Blog::where("id",$id)->first();
   $posts=Post::where ("blog",$id)->get();
   return view('vedi_questo_blog')
         ->with('blog',$blog)->with('posts',$posts);
}

// fin qui ok e i messaggi spostati su messaggi controller

//sistemazione blog amico
public function listablogamico($idamico){  //è id amico
  $username=Users:: where ("id",$idamico)->value("username");

  $blogsamico=Blog::where("utente_proprietario",$idamico)->get();
 return view('lista_blogs_amico')
         ->with('blogsamico',$blogsamico)->with('username',$username);

   }

//parte per le richieste

 public function mostraRichieste(){   // mi mostra solo quelle in attesa di una risposta, poi nei messaggi rimane memorizzato quando ho risposto a chi mi ha chiesto
  $richieste_amicizia=$this->richiestemodel->getAmiciziaRichieste();

  return view('richieste')
   ->with('richieste_amicizia',$richieste_amicizia);
 }


 public function richiestaRisposta($id, $risposta)
    {

        $richiesta = $this->richiestemodel->getRichiesta($id);
        $richiesta->data_risposta = Carbon::now();
        $richiesta->stato = $risposta;
        $richiesta->update();

        //questo ora li uso per i messaggi di notifica e registrare amicizia se è stata accettata
        $richiedente=Richieste::where("id",$id)->value("richiedente");


          // se accetto devo notificare all'interessato che ora siamo amici tramite messaggio
          //poi DEVO anche creare una riga nella tabella amici dove di fatto registro il fatto che effettivamente siamo amici
        if ($risposta == 2) {

            //qui creo il messaggio automatico di notifica
            $messaggio = new Messaggi([
            'contenuto' => "Ho appena accettato la tua richiesta di amicizia,benvenuto nel mio gruppo di amici! ",
            'data' => Carbon::now(),
            'mittente' => auth()->user()->id,
            'destinatario' =>$richiedente
            ]);
            $messaggio->save();
            //qui memorizzo nel db la nuova relazione di amicizia
            $amicizia = new Amici([
             'utente_riferimento' => auth()->user()->id,
            'amico_utente_riferimento' =>$richiedente
            ]);
            $amicizia->save();
            }
         if ($risposta == 0) {  //con un messaggio devo notificare che non ho accettato

         $messaggio = new Messaggi([
            'contenuto' => "Ho appena rifiutato la tua richiesta di amicizia ",
            'data' => Carbon::now(),
            'mittente' => auth()->user()->id,
            'destinatario' => $richiedente
            ]);
            $messaggio->save();
            }

            //torno alla rotta richieste :se ci sono altre a cui rispondere le vedrò, se ho già risposto a tutte le mie richieste allora non le vedrò
            return redirect()->route('vedirichieste')
            ->with('status', 'Operazione effettuata correttamente!');

   }//chiude funzione

//fin qui ok

//per inviare richiesta e di amicizia


// devo creare la richiesta nel db e poi devo anche crare il messaggio di notifica

public function inviarichista($user){  //parametro è id dell0utente a cui chiuedo amicizia

    $richiesta = new Richieste([
             'richiedente' => auth()->user()->id,
            'accettante' =>$user,
            'data_richiesta' => Carbon::now(),
           'stato' => 1
            ]);
            $richiesta->save();

 $messaggio = new Messaggi([
            'contenuto' => "Ti ho appena inviato una richiesta di amicizia,corri a vederla ",
            'data' => Carbon::now(),
            'mittente' => auth()->user()->id,
            'destinatario' => $user
            ]);
            $messaggio->save();

//poi voglio che mi riporta sulla pagina di ricerca con i risultati di prima senza quello che ho appena scelto
//questa parte da finire

// <a href="{{ url()->previous() }}">Back</a> meccanismo da usare nel return

//potrebbe anche funzionare questa , ma è da provare
return redirect()->back()->with('status', 'richiesta effettuata correttamente!');

}



//ora iniia parte per cercare le persone  PARTE FINALE

 public function cercautenti(Request $ricerca)  {

    $loggato=auth()->user()->id;  //mi serve per controlli in query successive

    $nomeinserito=strtoupper($ricerca->name); //prendo il nome che ho inserito per confrontarlo con quelli nel db
                                               //lo metto subito in maiuscolo

     //so che ho inserito una  STRINGA e quindi la posso trattare come un particolare array di caratteri
    //voglio SUBITO  capire se ho usato il jolly * , in modo eventualmente da toglierlo poi nella query di ricerca

    $lunghezza=strlen($nomeinserito);
   // $lunghezza=count($nomeinserito); potrei anche usare questo perche è un array di caratteri
    $nomesenzajolly=[];

    if($nomeinserito[$lunghezza-1]=='*'){  //vedo se ultimo carattere inserito è il jolly

       for($i=0;$i<$lunghezza-1;$i++){
       $nomesenzajolly[$i]=$nomeinserito[$i];
       }
            $nomeinserito=$nomesenzajolly;  //salvo valore senza jolly

            $lunghezza=strlen($nomeinserito);  //aggiorno lunghezza perche ho eliminato il jolly

    } //in questo modo elimino il carattere jolly (se era stato messo) come ultimo carattere (mi resta tutto l'altro)

   //ora estraggo i nomi di tutti gli utenti nel sito per poi confrontarli con quello che utente ha inserito nella barra di ricerca
   //prendo anche id perchè poi mi serve per recuperare le altre info, anche perche se ho messo tutto in maiuscolo poi ricercare è complicato

   //prova
   $nomi=Users::where("livello","utente ")->select("name","id")->get()-toArray();   //prendo id e nome di tutti gli utenti
                                                                     //offset 0 è "name"
                                                                     //offset 1 è "id"

//    substr($stringa, 0, $lunghezza);   questa è una funzione base per gestire le stringhe
//mi prendo per ogni $stringa di nomi che passo  i primi $lunghezza caratteri in modo da confrontarli con  il campo messo dall'utente con
//un'altra funzione apposita

//strpos($stringa,$sottostringa) mi serve per sapere se la sottostringa è presente in stringa
// se è vero mi restituisce offset di $stringa dove inizia la sottostringa,altrimenti false
// a me basta sapere se è contenuta, percio che risultato sia diverso da false
   $j=0;
   $idtrovati=[];//ci voglio mettere id degli utenti che corrispondono alla ricerca

   foreach ($nomi as $nome) {  //lo uso cosi lavoro su TUTTI i valori si $nomi

             $nome[0]=strtoupper($nome[0]);  //lo metto in maiuscolo cosi sono nello stasso 'case' dei caratteri di $nomeinserito

               if( strpos($nome[0],$nomeinserito)!= false ){    // se è diverso da false significa che $nomeinserito è contenuto in $nome[0]
               $app=Users::where("id",$nome[1])->value("id");    // e quindi id  del corrispondente utente va selezionato
               $idtrovati[$j]=$app ;
               $j++;     //salvo a partire da offset j=0 e poi lo aggiorno cosi se ci sono altri mi salva in offset magggiorato
               }// fine if



      }//fine for each

// se tutto scritto bene ora in $idtrovati ho tutti gli id degli utenti che corrispondono alla ricerca

//alcuni potrebbero però già essere miei amici, quindi devo trovare gli id dei miei amici e toglierli da questo vettore
//perchè voglio che dalla ricerca escano fuori solo  gli utenti che attualmente non sono  miei amici

  $app1=Amici::where("utente_riferimento",$loggato)->select("amico_utente_riferimento")->toArray();  //amici left
  $app2=Amici::where("amico_utente_riferimento",$loggato)->select("utente_riferimento")->toArray();   //amici right
  $uniti1=array_merge($app1,$app2);  // cosi ho tutti gli id dei miei amici

     for($i=0;$i<count($uniti1);$i++){
            $app3= Users:: where('id','=',$uniti1[$i])->value( "id");
            $idamico[$i]=[$app3];
        }  //ho recupaerato tutti i valori degli id dei miei amici

 //adesso da $idtrovati[] devo eliminiare gli id che sono presenti in $idamico
 // posso usare array_diff($a1,$a2) che per rirultato darà i valori di a1 che non compaiono in a2

$ridotto=[];
$ridotto=array_diff($idtrovati,$idamico);


    $trovati=[]; // vettore in cui salvo info dei soli utenti che corrisponodono ai requisiti della ricerca e che quindi voglio far comparire
                 //nella view come risultati della ricerca
    for($r=0;$r<count($ridotto);$r++){
     $off0= Users:: where('id','=',$ridotto[$r])->value( "name");
     $off1= Users:: where('id','=',$ridotto[$r])->value( "cognome");
     $off2= Users:: where('id','=',$ridotto[$r])->value( "username");
     $off3= Users:: where('id','=',$ridotto[$r])->value( "sesso");
     $off4= Users:: where('id','=',$ridotto[$r])->value( "data_nascita");
     $off5= Users:: where('id','=',$ridotto[$r])->value( "foto_profilo");
     $off6= Users:: where('id','=',$ridotto[$r])->value( "descrizione");
     $off7= Users:: where('id','=',$ridotto[$r])->value( "id");
     $off8= Users:: where('id','=',$ridotto[$r])->value( "visibilita");  // mi serve per capire se mostro tutto o no
     $off9=Richieste::where("richiedente",$loggato)->where("accettante",$ridotto[$r])->where("stato",1)->count(); //mi serve per controllo nella view
             // se c'è gia una richiesta in stato di attesa tra me e lui ,per cui risultato sarà >0, non devo inviare ancora richiesta
     $trovati[$r]=[$off0,$off1,$off2,$off3,$off4,$off5,$off6,$off7,$off8,$off9];
    }



        return view('cercapersone')
           ->with('trovati',$trovati) ;
    }//chiude funzione di ricerca utenti


}
// chiude il controller

