@extends('layouts.admin')

@section('title', 'statistiche')

@section('content')
<div class="w3-container w3-padding-32" id="catalog" align="center">

    <h4> DA QUI vedi le statistiche </h4><br>
//////


<div class="container-contact">
        <div class="wrap-contact1">
            {{ Form::open(array('route' => 'register', 'files' => true, 'class' => 'contact-form')) }}

            <div class="wrap-input">
                {{ Form::label('', '', ['class' => 'fa fa-user']) }}
                {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                {{ Form::text('username', '', ['class' => 'input','id' => 'username']) }}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>


            <div class="container-form-btn">
                {{ Form::submit('Filtra statistiche relative all'utente che hai scelto , ['class' => 'my-button']) }}
            </div>



            {{ Form::close() }}
        </div>
    </div>






//////////
</div>
@endsection
