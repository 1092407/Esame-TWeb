@extends('layouts.utente')

@section('title', 'cerca amici')

@section('scripts')
@parent
<script language="JavaScript" type="text/javascript">

  $(function() {
    $(".alert").show().delay(2000).fadeOut("show");
  })
</script>
@endsection

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

<h2>Qui puoi cercare altri membri della comunità e inviare richieste di amicizia </h2><br>

<h4>Scrivi un nome nella barra di ricerca e per gli utenti con quel nome vedrai tutte le informazioni se il profilo è  pubblico,
 il solo nome e cognome se il profilo è privato. In ogni caso potrai inviare a chiunque una richiesta di amicicizia se non lo hai già fatto.
Nella ricerca puoi usare come ultimo carattere '*' che funge da wild card.
 Esempio: scrivendo "Lu*" in automatico avrai come risultato
tutti gli utenti il cui nome iniza per "Lu" come  "Luigi","Luca","Lucrezia"...
</h4><br>


    <div class="w3-container" style="padding-top:10px">
    <h4>Effettua qui sotto la ricerca  di altri utenti tramite nome</h4>



    {!! Form::open(array('route'=>'search','method'=>'GET','id'=>'ricerca')) !!}
    {{ Form::text('name',isset($request) ? $request->name : false,array('id'=>'my-searchbar','placeholder'=>'inserisci qui il nome che intendi cercare')) }}
    {{ Form::submit('Cerca',array('class'=>'w3-button'))}}
    {!! Form::close() !!}
    <hr>
     </div>

      @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif


@isset($trovati)


<p class="w3-margin" style='padding-left:1%; padding-right:1%;'>Ecco gli utenti trovati</b></p>



<div class="w3-row-padding" style='padding-left:1%;padding-right:1%;'>


<div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">Nome</b></td>
            <td><b style="font-size:18px;">Cognome</b></td>
            <td><b style="font-size:18px;">Username</b></td>
             <td><b style="font-size:18px;">Sesso</b></td>
            <td><b style="font-size:18px;">Data di nascita</b></td>
             <td><b style="font-size:18px;">Foto profilo</b></td>

            <td><b style="font-size:18px;">Descrizione</b></td>

            <td colspan=1><b style="font-size:18px;">Azione</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach($trovati as $trovato)
          <tr>

        @if($trovato[8]=='pubblico' or ($trovato[8]=='privato' and $trovato[10]!=0 ))
            <td>{{$trovato[0]}}</td>
            <td>{{$trovato[1]}}</td>
            <td>{{$trovato[2]}}</td>
            <td>{{$trovato[3]}}</td>
            <td>{{$trovato[4]}}</td>
            <td >
            @include('helpers/profileImage', ['attrs' => '' , 'imgFile'=>$trovato[5],'style'=>'width:10%'])
            </td>
             <td>{{$trovato[6]}}</td>
        @endif

        @if($trovato[8]=='privato' and $trovato[10]==0)
            <td>{{$trovato[0]}}</td>
            <td>{{$trovato[1]}}</td>
            <td>non disponibile</td>
            <td>non disponibile</td>
            <td>non disponibile</td>
            <td>non disponibile</td>
           <td>non disponibile</td>
        @endif



             @if($trovato[9]==0 and $trovato[10]==0)
              <td>
              <a href = "{{route('inviarichista',$trovato[7])}}" class="w3-button w3-blue">Invia richiesta</a>
            </td>
             @endif

             @if($trovato[9]>0 and $trovato[10]==0)
              <td>
             {{'esiste già una richiesta tra di voi'}}
            </td>
             @endif

              @if($trovato[10]!=0)
              <td>
             {{'siete già amici'}}
            </td>
             @endif




          @endforeach
        </tbody>
      </table>


   </div>



</div>


@endisset



</div>
@endsection
