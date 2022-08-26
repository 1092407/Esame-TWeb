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


                 @if($amici==['    '])

                     @endif






      <table class="w3-table-all table-striped">
        <thead>
          <tr>


            <td><b style="font-size:18px;">nome</b></td>
            <td><b style="font-size:18px;">cognome</b></td>
            <td><b style="font-size:18px;">username</b></td>

     <td colspan=2><b style="font-size:18px;">azioni</b></td>

          </tr>
        </thead>

  @if($amici!=['    '])
        <tbody>



          @foreach($amici as $amico)
          <tr>


            <td>{{$amico[0]}}</td>


            <td>{{$amico[1]}}</td>
            <td>{{$amico[2]}}</td>

              <td>
               <a href="javascript:void(0)"  class="w3-button w3-blue" onclick="document.getElementById('messaggio').style.display='block'">Vedi suoi blogs</a>
            <div style="width:100%">


                                <div id="messaggio" class="modal" style="z-index:4">
                                    <div class="w3-modal-content w3-animate-zoom">
                                              <div class="w3-container w3-padding w3-blue">
                                                <h2>Ecco i blogs di  {{$amico[2]}} </h2>
                                                </div>
                                        <div class="w3-panel">

                                             <table class="w3-table-all table-striped">
                                                <thead>
                                                      <tr>
                                                        <td><b style="font-size:18px;">titolo</b></td>
                                                         <td><b style="font-size:18px;">descrizione</b></td>
                                                          <td><b style="font-size:18px;">visualizza</b></td>
                                                       </tr>
                                                   </thead>

                                                    <tbody>


                                                    @php

                                                    $blogsamicileft=App\Models\Blog::where("utente_proprietario",$amico[3])->get();
                                                    @endphp


                                              @foreach($blogsamicileft as $blogamicoleft)
                                                  <tr>
                                                  <td>{{$blogamicoleft->titolo}}</td>
                                                   <td>{{$blogamicoleft->descrizione }}</td>

                                                             <td>
                                                       <a href = "{{route('utente')}}" class="w3-button w3-blue">Vai a questo blog</a>
                                                          </td>



                                                      @endforeach



                                                </tbody>


                                                </table>

                                                 <div class="w3-section">
                                                <a class="w3-button w3-red" style="width:150px" onclick="document.getElementById('messaggio').style.display='none'">Annulla <i class="fa fa-remove"></i></a>

                                                </div>

                                        </div>
                                    </div>
                                </div>


                </div>








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

@endif



</div>
</div>


<div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">


                 @if($amiciright==['    '])

                     @endif



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



  @if($amiciright!=['    '])
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
@endif

</div>
</div>



@endsection
