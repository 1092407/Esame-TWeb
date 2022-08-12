@extends('layouts.public')

@section('title', 'Chi Siamo')

@section('content')
<!-- About Section -->
<div class="w3-container w3-padding-32">
  <h2 class="w3-border-bottom w3-border-light-grey w3-padding-16" align="center"><b>Descrizione Generale</b></h2>
  <p> <b>Blo  è un portale tramite cui puoi condividere con i tuoi amici i tuoi pensieri e idee</b>.

    La piattaforma utilizza un’interfaccia efficace che consente a te e ai tuoi amici  di vivere una esperienza unica per la condivisione di idee tramite blog da te creati.
    <b>Il tutto comodamente da computer, tablet o smartphone collegandoti al nostro sito</b>.
  </p>
  <p><b>Blo </b> unisce l’innovazione delle start-up, la professionalità di un'agenzia immobiliare
    e l’esperienza di fuorisede del proprio staff, così da offrire soluzioni concrete al generale disorientamento
    che caratterizza il mondo dell’housing universitario.</p>
  <p>È un servizio progettato per offrirti un qualcosa in più.
    <b>Fornisce assistenza  e manutenzione</b> nel caso dovessi incontrare  delle criticità nell'esperienza  della nostra comunità.
  </p>
  <p><b>Semplice e veloce offre un  servizio ideale per i giovani  e non solo .</b></p>
</div>
<h2 class="w3-border-bottom w3-border-light-grey w3-padding-16" align="center"><b>La Nostra Missione</b></h2>
<p>Il nostro scopo è quello di offrire un servizio di svago ma anche di utile condivisione di idee e pensieri .<br>
  Il nostro punto di forza è il facile utilizzo della piattaforma , che migliorerà  di certo le tue giornate di stressante lavoro o studio .
  Questo è uno dei grandi scopi che ci siamo prefissati.<br>
  Mettete a disposizione i vostri pensieri... al resto ci pensiamo noi!
</p>
<div class="w3-row-padding ">
  <div class="w3-col l3 m6 w3-margin-bottom w3-grayscale hover-no-filter transition">
    <img src="{{asset('img/foto_profilo/fil.jpg')}}" alt="Mariuc" style="width:120%" class='thumb'>
    <h3>Filippo Mariucci</h3>
    <p class="w3-opacity">Developer</p>
    <p>Studente di Ingegneria Informatica e dell'Automazione presso l'Università Politecnica delle Marche.</p>
    <p>
    <form method="get"> <button type="submit" class="w3-button w3-light-grey w3-block" formaction="mailto:filippo.mariucci@blo.it">Contattami</button></form>
    </p>
  </div>
  <div class="w3-col l3 m6 w3-margin-bottom w3-grayscale hover-no-filter transition">
    <img src="{{asset('img/foto_profilo/gio.jpg')}}" alt="Giorgione" style="width:110%" class='thumb'>
    <h3>Giorgio Olivieri</h3>
    <p class="w3-opacity">Developer</p>
    <p>Studente di Ingegneria Informatica e dell'Automazione presso l'Università Politecnica delle Marche.</p>
    <p>
    <form method="get"> <button type="submit" class="w3-button w3-light-grey w3-block" formaction="mailto:giorgio.olivieri@blo.it">Contattami</button></form>
    </p>
  </div>


</div>
@endsection
