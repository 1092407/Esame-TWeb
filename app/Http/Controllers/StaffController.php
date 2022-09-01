<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\GreaterThan;
use App\Models\Resources\Users;
use App\Http\Requests\NewstaffRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\Blog;
use App\Models\Amici;
use App\Models\Resources\Richieste;
use App\Models\Resources\Post;
use App\Models\Resources\Messaggi;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;





class StaffController extends Controller
{
   protected $lista;   // sarebbe usermodel ma la chiamo lista perche idea è recuperare info
   protected $blogmodel;
   protected $postmodel;
   protected $richiestemodel;
   protected $amicimodel;

     public function __construct(){
        $this->middleware('can:isStaff');
        $this->lista = new Users;
        $this->blogmodel = new Blog;
        $this->richiestemodel = new Richieste;
        $this->amicimodel = new Amici;
        $this->postmodel = new Post;
    }



//mi fa vedere la lista di tutti i blogs presenti
   public function showallblogs(){

        $blogs = Blog::all();  // funzione definita in Users model e lanciata qui

        return view('gestioneblog')
                ->with('blogs',$blogs);
    }


   public function showthisblog($id){ // id del blog

     $blog=Blog::where("id",$id)->first();

      $posts=Post::where ("blog",$id)->get();


     return view('vedi_questo_blog')
         ->with('blog',$blog)->with('posts',$posts);
     } //ok

  //elimina un post e mi riporta a vedere il blog aggiornato senza quel post
  public function deletepost($idpost)
    {
        $post=Post:: where("id",$idpost)->first();
        $app=Post::where("id",$idpost)->value("blog");    // serve per passarlo alla rotta che mi porta a vedere il blog aggiornato dopo eliminazione

        $nomeblog=Blog::where("id",$app)->value("titolo");
        $app2=Blog::where("titolo",$nomeblog)->value("utente_proprietario");
        $app3=Users::where("id",$app2)->value("username");

        $app4=Post:: where("id",$idpost)->value("scrittore"); //è username di chi scrive il post
        $app5=Users::where("username",$app4)->value("id");

       $messaggio = new Messaggi([
            'contenuto' => "il tuo post : (".$post->contenuto.")è stato eliminato dal blog  ".$nomeblog."  di  ".$app3."  perchè non conforme alla nostra politica sui contenuti ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $app5

        ]);

        $messaggio->save();


     $post->delete();


        return redirect()->route('vedi_questo_blog_staff',$app)
        ->with('status', 'post eliminato correttamente correttamente!');
    }




  public function deletethisblog($idblog)
    {
    $nomeblog=Blog::where("id",$idblog)->value("titolo");
      $blog=Blog::where("id",$idblog)->first();


        $app=Blog:: where("id",$idblog)->value("utente_proprietario");

     $messaggio = new Messaggi([
            'contenuto' => "il tuo blog ".$nomeblog." è stato eliminato perchè non conforme alla nostra politica sui contenuti ",
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $blog->utente_proprietario

        ]);

        $messaggio->save();

     $blog->delete();


        return  redirect()->route('listablogs.staff')
            ->with('status', 'blog eliminato correttamente!');
    }








}
