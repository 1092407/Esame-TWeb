@extends('layouts.utente')

@section('title', 'cerca amici')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

<h2>Qui puoi cercare altri membri della comunità e inviare richieste di amicizia </h2><br>

<h4>Scrivi un nome nella barra di ricerca e per gli utenti con quel nome vedrai tutte le informazioni se il profilo è  pubblico,
 il solo nome e cognome se il profilo è privato. In ogni caso potrai inviare a chiunque una richiesta di amicicizia.
Nella ricerca puoi usare come ultimo carattere '*' che funge da wild card.
 Esempio: scrivendo "Lu*" in automatico avrai come risultato
tutti gli utenti il cui nome iniza per "Lu" come  "Luigi","Luca","Lucrezia"...
</h4><br>


<div class="w3-container" style="padding-top:10px">
    <h4>Effettua qui sotto la ricerca  di altri utenti tramite nome</h4>
    {!! Form::open(array('route'=>'utente','method'=>'GET','id'=>'ricerca')) !!}
    {{ Form::text('name',isset($request) ? $request->name : false,array('id'=>'my-searchbar','placeholder'=>'inserisci qui il nome che intendi cercare')) }}
    {{ Form::submit('Cerca',array('class'=>'w3-button'))}}
    {!! Form::close() !!}
    <hr>

</div>


</div>
@endsection
