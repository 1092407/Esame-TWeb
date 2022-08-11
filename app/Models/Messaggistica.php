<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Messaggi;
use App\User;


class Messaggistica extends Model
{
    public function getChat($id){       // questa funzione l'ho modificata , giorgio

        //tabella delle chat dove $id é il mittente
        $chatMittente = Messaggi::where("mittente",$id)->select("destinatario",)->get();

        //tabella delle chat dove $id è destinatario
        $chatDestinatario = Messaggi::where("destinatario",$id)->select("mittente",)->get();

        //unisco le due tabelle in unico array


        $contatti = [];
        foreach([$chatMittente,$chatDestinatario] as $chat){
            foreach ($chat as $message){
                if(isset($message->destinatario)){
                    $contatti[$message->destinatario]=0;
                } else {
                    $contatti[$message->mittente]=0;
                }
            }
        }

        $result = [];
        $i = 1;
        foreach(array_keys($contatti) as $key_user){
            foreach(array_keys($contatti[$key_user]) as $key_alloggio){
                $result[$i]=[

                    "utente"=>User::where("id",$key_user)->get()
                ];
                $i++;

            }
        }

        return $result;
    }




// questa sotto da rivedere , giorgio


    /*Destinatario in questo caso è quello che è loggato nel sito, mentre il mittente è colui del quale ci interessa
    vedere la conversazione, questo metodo ritorna i messaggi salvati dell'utente loggato */
    public function getConversazione($destinatario, $mittente){

        $messaggi = Messaggi::select("contenuto","data","mittente","destinatario")
        ->whereIn("destinatario",[$destinatario,$mittente])->whereIn("mittente",[$destinatario,$mittente])
        ->orderBy("data","asc")->get();
        $mittente = User::where("id", $mittente)->get();

        return ["messaggi"=>$messaggi,"mittente"=>$mittente];

    }
}
