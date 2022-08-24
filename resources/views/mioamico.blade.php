@extends('layouts.utente')

@section('title', 'miei amici')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">


<div class="w3-main" style="margin-left:30px">

<h1> Ecco i tuoi amici </h1>

      @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif

  <!-- First Photo Grid-->
  <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">


      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">nome</b></td>
            <td><b style="font-size:18px;">cognome</b></td>
            <td><b style="font-size:18px;">username</b></td>

     <td colspan=2><b style="font-size:18px;">azioni</b></td>

          </tr>
        </thead>


        <tbody>



          @foreach($amici as $amico)
          <tr>


            <td>{{$amico[0]}}</td>


            <td>{{$amico[1]}}</td>
            <td>{{$amico[2]}}</td>

              <td>
              <a href = "{{route('utente')}}" class="w3-button w3-blue">Vedi Blogs</a>
            </td>

               <td>
              <form action="{{ route('friendleft.delete', $amico[3])}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo amico?')">Elimina amico</button>
              </form>
            </td>





          @endforeach


        </tbody>

      </table>





</div>
</div>


<div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">

       <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;"></b></td>
            <td><b style="font-size:18px;"></b></td>
            <td><b style="font-size:18px;"></b></td>

             <td colspan=2><b style="font-size:18px;"></b></td>

          </tr>
        </thead>


        <tbody>


          @foreach($amiciright as $amicoright)
          <tr>
            <td>{{$amicoright[0]}}</td>
            <td>{{$amicoright[1]}}</td>
            <td>{{$amicoright[2]}}</td>


              <td>
              <a href = "{{route('utente',)}}" class="w3-button w3-blue">Vedi Blogs</a>
            </td>

              <td>
              <form action="{{ route('friendright.delete', $amicoright[3])}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo amico?')">Elimina amico</button>
              </form>
            </td>

          @endforeach



        </tbody>


      </table>


</div>
</div>



@endsection
