@extends('layouts.admin')

@section('title', 'gestione staff')


@section('content')

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
      <h1 id="titolo" style="margin-bottom:0px;"><b>Gestione staff</b></h1>

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

            <td><b style="font-size:18px;">sesso</b></td>
            <td><b style="font-size:18px;">data nascita</b></td>
            <td><b style="font-size:18px;">email</b></td>
            <td><b style="font-size:18px;">username</b></td>
            <td><b style="font-size:18px;">descrizione</b></td>




            <td colspan=2><b style="font-size:18px;">Azioni</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach($staffs as $staff)
          <tr>
            <td>{{$staff->name}}</td>
            <td>{{$staff->cognome}} </td>
            <td>{{$staff->sesso}}</td>
            <td>{{$staff->data_nascita}} </td>
            <td>{{$staff->email}}</td>
            <td>{{$staff->username}} </td>
            <td>{{$staff->descrizione}}</td>


              <td>
              <a href = "{{route('staff.toupdate',$staff->id)}}" class="w3-button w3-blue">Modifica</a>
            </td>

              <td>
              <form action="{{ route('staff.delete', $staff->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo membro dello staff?')">Elimina</button>
              </form>
            </td>

          @endforeach
        </tbody>
      </table>



      @endsection


