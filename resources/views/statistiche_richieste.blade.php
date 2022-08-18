@extends('layouts.admin')

@section('title', 'statistiche richieste')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">


<div class="w3-main" style="margin-left:30px">

   <h1> Ecco informazioni sulle richieste a lui pervenute </h1>

  <!-- First Photo Grid-->
  <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">Totale richieste ricevute</b></td>
            <td><b style="font-size:18px;">Di cui acettate</b></td>


          </tr>
        </thead>


        <tbody>


         <tr>


          @isset($totali)
            <td>{{$totali}}</td>
          @endisset
          @isset($accettate)
            <td>{{$accettate}}</td>
          @endisset
        </tr>






        </tbody>


      </table>


</div>

@endsection
