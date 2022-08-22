@extends('layouts.admin')

@section('title', 'statistiche blogs')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">


<div class="w3-main" style="margin-left:30px">

   <h1> Ecco i suoi blog </h1>

  <!-- First Photo Grid-->
  <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">titolo</b></td>
            <td><b style="font-size:18px;">descrizione</b></td>

          </tr>
        </thead>


        <tbody>


          @foreach($blogs as $blog)
          <tr>
            <td>{{$blog->titolo}}</td>
            <td>{{$blog->descrizione}}</td>




          @endforeach



        </tbody>


      </table>


</div>
</div>
@endsection
