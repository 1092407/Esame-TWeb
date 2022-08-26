@extends('layouts.utente')

@section('title', 'miei blog')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

    <h4>  Ecco i tuoi blog</h4><br>

      @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif

<a href = "{{route('creablog')}}" class="w3-button w3-green">Crea nuovo blog</a>

 <div style="padding-left: 20px; padding-right: 20px;">
    <div class="col-sm-12">
      <table class="w3-table-all table-striped">
        <thead>
          <tr>
            <td><b style="font-size:18px;">Titolo</b></td>
            <td><b style="font-size:18px;">Descrizione</b></td>


            <td colspan=2><b style="font-size:18px;">Azioni</b></td>
          </tr>
        </thead>
        <tbody>
          @foreach($blogs as $blog)
          <tr>
            <td>{{$blog->titolo}}</td>
            <td>{{$blog->descrizione}} </td>



              <td>
              <a href = "{{ route('questoblog', $blog->id)}}" class="w3-button w3-blue">Visualizza</a>
            </td>


             <td>
              <form action="{{ route('blog.delete', $blog->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo blog?')">Elimina</button>
              </form>
            </td>



          @endforeach
        </tbody>
      </table>






</div>









</div>
@endsection
