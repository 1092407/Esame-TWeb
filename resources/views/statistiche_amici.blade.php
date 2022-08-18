@extends('layouts.admin')

@section('title', 'statistiche amici')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">


<div class="w3-main" style="margin-left:30px">

<h1> Ecco i suoi amici </h1>

  <!-- First Photo Grid-->
  <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">nome</b></td>
            <td><b style="font-size:18px;">cognome</b></td>
            <td><b style="font-size:18px;">username</b></td>

          </tr>
        </thead>


        <tbody>


          @foreach($amici as $amico)
          <tr>
            <td>{{$amico->nome}}</td>
            <td>{{$amico->cognome}}</td>
            <td>{{$amico->username}}</td>



          @endforeach



        </tbody>


      </table>


</div>

@endsection
