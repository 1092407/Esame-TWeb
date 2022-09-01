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


use Illuminate\Support\Facades\File;
use Carbon\Carbon;





class MessaggiController extends Controller
{

protected $usersmodel;
protected $blogmodel;
protected $amicimodel;
protected $postmodel;
protected $messaggisticamodel;


       public function __construct(){
        $this->usersmodel = new Users;
        $this->blogsmodel = new Blog;
        $this->amicimodel = new Amici;
        $this->postmodel = new Post;
        $this->messaggisticamodel = new Messaggistica;
        }



//questa mi ritorna le varie chat nella colonna a sx della view per visualizzare i _messaggisticaModel

 public function showMessaggi()
    {
        $chat = $this->messaggisticamodel->getChat(auth()->user()->id);

        return view("messaggi")
            ->with('chat', $chat);
    }


// mi mostra la conversazione con un certo destinatario
  public function showChat($destinatario)
    {
        $chat = $this->messaggisticamodel->getChat(auth()->user()->id);  //mi serve per mantenere a sx la lista delle chat anche se ne apro una a dx

        $messaggi = $this->messaggisticamodel->getConversazione(auth()->user()->id, $destinatario);

        return view("messaggi")
            ->with('chat', $chat)
            ->with('messaggi', $messaggi)
            ->with('id', auth()->user()->id);
    }


   public function rispondiMessaggio(Request $request, $id_destinatario)
    {
        $chat = $this->messaggisticamodel->getChat(auth()->user()->id);
        $messaggi = $this->messaggisticamodel->getConversazione(auth()->user()->id, $id_destinatario);

        $request->validate([
            'messaggio' => 'required|string|max:2500'
        ]);

        $messaggio = new Messaggi([
            'contenuto' => $request->get('messaggio'),
            'data' => Carbon::now()->addHours(2),
            'mittente' => auth()->user()->id,
            'destinatario' => $id_destinatario

        ]);

        $messaggio->save();

        return redirect()->route('conversazione', $id_destinatario)
            ->with('chat', $chat)
            ->with('messaggi', $messaggi)
            ->with('id', auth()->user()->id);
    }






}
