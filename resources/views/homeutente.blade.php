@extends('layouts.utente')

@section('title', 'utente')


@can('isUtente')
<br>
@endcan

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

    <h4> DA QUI PUOI VIVERE LA TUA ESPERINZA CON BLO !</h4><br>
    <h4> Puoi iniziare ad usufruire di tutti i servizi messi a disposizione per te che fai parte della nostra esclusiva  comunità </h4><br>
     <h4> Puoi creare blog su ogni argomento desideri e pubblicare post da condividere con i tuoi amici </h4><br>
     <h4> Puoi cercare  e scegliere tra gli uetnti già registrati i tuoi nuovi amici virtuali</h4><br>
     <h4> Una volta diventato amico di un altro utente puoi vedere i suoi blog e pubblicarci post </h4><br>
      <h4> Puoi controllare e modificare i tuoi dati personali</h4><br>


</div>
@endsection
