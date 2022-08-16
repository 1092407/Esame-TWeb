@extends('layouts.admin')

@section('title', 'statistiche')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">


<div class="w3-main" style="margin-left:30px">

  <!-- Header -->
  <header id="portfolio">
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
      <h1 id="titolo" style="margin-bottom:0px;"><b>Da qui vedi le informazioni  relative agli utenti della comunità</b></h1>

      @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif
    </div>
  </header>

  <!-- First Photo Grid-->
  <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">nome</b></td>
            <td><b style="font-size:18px;">cognome</b></td>


            <td><b style="font-size:18px;">username</b></td>
            <td><b style="font-size:18px;">descrizione</b></td>




            <td colspan=2><b style="font-size:18px;">Vedi</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->cognome}} </td>

            <td>{{$user->username}} </td>
            <td>{{$user->descrizione}}</td>


              <td>
              <a href = "{{route('staff.toupdate',$user->id)}}" class="w3-button w3-blue">Modifica</a>
            </td>

             <td>
              <a href = "{{route('show_blogs_of_user',$user->id)}}" class="w3-button w3-blue">Blogs</a>
            </td>



          @endforeach
        </tbody>
      </table>





////////// chide la sezione
</div>
@endsection
