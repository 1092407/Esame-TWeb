
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


 @section('links')
  <link rel="stylesheet" type="text/css" href= "{{ asset('css/blogpost.css') }}">
    <link rel="stylesheet" type="text/css" href= "{{ asset('css/w3-style.css') }}">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>

<!-- Navbar (sit on top) -->

@auth
                @can('isUtente')

                @include('layouts/_navutente')
                @endcan

                @can('isStaff')

                @include('layouts/_navstaff')
                @endcan

                @can('isAdmin')

                @include('layouts/_navadmin')
                @endcan
        @endauth





  <div class="headerBlog">

  <h2>Titolo: {{$blog->titolo}}</h2>
   <h4 > Descrizione: {{$blog->descrizione}} </h4>
   <br>
<a href="javascript:void(0)"  style="color:blue" onclick="document.getElementById('messaggio').style.display='block'">Aggiungi post</a>
  </div>


    @if(auth()->user()->livello=='utente' )
            <div style="width:100%">
                                <div id="messaggio" class="modal" style="z-index:4">
                                    <div class="w3-modal-content w3-animate-zoom">
                                        <div class="w3-container w3-padding w3-blue">
                                            <h2>scrivi qui il testo del tuo post</h2>
                                        </div>
                                        <div class="w3-panel">
                                            <div align='center'>
                                                {{ Form::open(array('route' => ['creaPOST_post', $blog->id], 'id'=>'messaggio', 'class' => 'animate')) }}

                                                {{ Form::textarea('contenuto','', ['class' => 'input-app w3-input w3-border', 'id' => 'contenuto', 'placeholder'=>'scrivi qui quello che vuoi pubblicare ']) }}<br>
                                            </div>
                                            <div class="w3-section">
                                                <a class="w3-button w3-red" style="width:150px" onclick="document.getElementById('messaggio').style.display='none'">Annulla <i class="fa fa-remove"></i></a>
                                                {{ Form::submit('Aggiungi post ', ['class' => 'w3-button w3-right w3-blue' , 'style'=> "width:150px"]) }}
                                                {{Form::close()}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    @endif

     @if (session('status'))
      <div class="alert success" style="position:fixed; margin-top:200px;">
        {{ session('status') }}
      </div>
      @endif


    <div class="posPost" >

  @foreach($posts as $post)

    <div class="card" style ="margin-top:10px; overflow-wrap: break-word" >
      <h2>Autore: {{$post->scrittore}}</h2>
      <h5>data: {{$post->data}}</h5>

      <p>{{$post->contenuto}}</p>

    @if(auth()->user()->livello=='admin' )

    <form action="{{ route('adminpost.delete', $post->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo post?')">Elimina questo post</button>
              </form>

    @endif

   @if( auth()->user()->livello=='staff')

    <form action="{{ route('staffpost.delete', $post->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo post?')">Elimina questo post</button>
              </form>

    @endif



    </div>

 @endforeach



  </div>


</body>



</html>
