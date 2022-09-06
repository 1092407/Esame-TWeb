@extends('layouts.utente')

@section('title', 'blog questo amico')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

    <h4>  Ecco i blogs del tuo amico: {{$username}}</h4><br>


 <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">Titolo</b></td>
            <td><b style="font-size:18px;">Descrizione</b></td>


            <td colspan=2><b style="font-size:18px;">Azione</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach($blogsamico as $blogamico)
          <tr>
            <td>{{$blogamico->titolo}}</td>
            <td>{{$blogamico->descrizione}} </td>



              <td>
              <a href = "{{ route('questoblog', $blogamico->id)}}" class="w3-button w3-blue">Visualizza</a>
            </td>


          @endforeach
        </tbody>
      </table>


                </div>










        </div>








</div>
@endsection
