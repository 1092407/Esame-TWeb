<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Messaggi;
use App\User;
use App\Models\Resources\Users;

class Messaggistica extends Model
{


    public function getChat($id){       // questa funzione serve per recuperare TUTTE LE CHAT  dell'utente attualmente loggato che è identificato da $id

        //dove $id é il mittente
        $idismittente = Messaggi::where("mittente",$id)->select("destinatario")->distinct()->get()->toArray(); //prendo i destinatari dei miei messaggi

       for($i=0;$i<count($idismittente);$i++){
            $app1= Messaggi:: where("mittente",$idismittente[$i] )->value( "destinatario");
             $idlist1[$i]=$app1;
        }


        //dove $id è destinatario
    $idisdestinatario = Messaggi::where("destinatario",$id)->select("mittente")->distinct()->get()->toArray();//prendo i mittenti dei messaggi che mi arrivano

       for($j=0;$j<count($idisdestinatario);$j++){
            $app2= Messaggi:: where("destinatario",$idisdestinatario[$j] )->value( "mittente");
             $idlist2[$j]=$app2;
        }

       //ora li unisco in un unico array: sono gli id degli utenti con cui il loggato ha una chat
       $idlisttot=$idlist1+$idlist2;


      //ora elimino valori doppi perchè la chat è unica con un certo utente:infatti in $idaltri potrei avere doppioni se con un certo utente io sono sia mittente che destinatario ma la chat con lui è sempre la stessa
      $idunici=array_unique($idlisttot);

  $result=[];
     for($y=0;$i<count($idunici);$y++){
            $app1= Users:: where('id','=',$idunici[$y])->value( "username");
            $app2= Users:: where('id','=',$idunici[$y])->value( "id");

             $result[$y]=[$app1,$app2];   //result[0] è username     mentre  [1] è id
        }//fine for

   return $result ;
    }



// questa sotto da rivedere


    /*Destinatario in questo caso è quello che è loggato nel sito, mentre il mittente è colui del quale ci interessa
    vedere la conversazione, questo metodo ritorna i messaggi salvati dell'utente loggato */
    public function getConversazione($destinatario,$mittente){

        $messaggi = Messaggi::select("contenuto","data","mittente","destinatario")
        ->whereIn("destinatario",[$destinatario,$mittente])->whereIn("mittente",[$destinatario,$mittente])
        ->orderBy("data","asc")->get();
        $mittente = User::where("id", $mittente)->get();

        return ["messaggi"=>$messaggi,"mittente"=>$mittente];

    }
}

