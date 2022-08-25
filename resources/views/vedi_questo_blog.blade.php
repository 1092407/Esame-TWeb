
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



     @if (session('status'))
      <div class="alert success">
        {{ session('status') }}
      </div>
      @endif


  <div class="header">
  <h2>{{$blog->titolo}}</h2>
   <h4>{{$blog->descrizione}}</h4>
</div>



<div class="row">
    <div class="leftcolumn">

  @foreach($posts as $post)

    <div class="card">
      <h2>{{$post->scrittore}}</h2>
      <h5>{{$post->data}}</h5>

      <p>{{$post->contenuto}}</p>

    @if(auth()->user()->livello=='admin' or auth()->user()->livello=='staff')


    <form action="{{ route('adminpost.delete', $post->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="w3-button w3-red" type="submit" onclick= "return confirm('Sei sicuro di voler eliminare questo post?')">Elimina questo post</button>
              </form>


    @endif





    </div>

 @endforeach



  </div>

</div>

</body>



</html>
