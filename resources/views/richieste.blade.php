@extends('layouts.utente')

@section('title', 'richieste amicizia')

@section('content')

<div class="w3-container w3-padding-32" id="catalog" align="center">

     <h4> Da qui vedi chi ti ha chiesto di diventare amici : puoi scegliere se accettare o rifiutare ogni richiesta </h4><br>

      @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif



 <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>


           <td><b style="font-size:18px;">foto</b></td>
          <td><b style="font-size:18px;">nome</b></td>
          <td><b style="font-size:18px;">cognome</b></td>
          <td><b style="font-size:18px;">username</b></td>
          <td><b style="font-size:18px;">descrizione</b></td>
          <td><b style="font-size:18px;">Data Richiesta</b></td>


            <td colspan=2><b style="font-size:18px;">Azioni</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach($richieste_amicizia as $richiesta)
          <tr>

           <td >
           @include('helpers/profileImage', ['attrs' => '' , 'imgFile'=>$richiesta->foto_profilo,'style'=>'width:10%'])
           </td>

            <td>{{$richiesta->name}}</td>
            <td>{{$richiesta->cognome}}</td>
            <td>{{$richiesta->username}}</td>
            <td>{{$richiesta->descrizione}}</td>
            <td>{{$richiesta->data_richiesta}}</td>




             <td><form action="{{ route('richiestaRisposta', [$richiesta->id, 2])}}" method="post" >
                @csrf
                @method('PUT')
                <button class="w3-button w3-green" type="submit" onclick= "return confirm('Sei sicuro di voler accettare l\'amicizia?')">Accetta</button>
            </form></td>
            <td><form action="{{ route('richiestaRisposta', [$richiesta->id, 0])}}" method="post" >
                @csrf
                @method('PUT')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler rifiutare l\'amicizia?')">Rifiuta</button>
            </form></td>
        </tr>
        @endforeach


        </tbody>
      </table>






   </div>
</div>








@endsection
