@extends('layouts.admin')

@section('title', 'admin')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

    <h4> DA QUI GESTISCI AL MEGLIO  LA TUA  COMUNITA !</h4><br>
    <h4> Qui puoi vedere le statistiche relative le attività degli utenti e gestire comodamente  i membri del tuo staff </h4><br>

     @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif


</div>
@endsection
