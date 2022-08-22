@extends('layouts.utente')

@section('title', 'crea nuovo blog')


@section('content')


<div class="static w3-center">
    <h2><b>Crea un blog</b></h2>
    <p>Utilizza questa form per creare il tuo nuovo blog .</p>
    <hr>
    <div class="container-contact">
        <div class="wrap-contact1">
            {{ Form::open(array('route' => 'creablog_post', 'files' => true, 'class' => 'contact-form')) }}



                <div class="wrap-input">
                    {{ Form::label('', '', ['class' => ' fa fa-id-card-o']) }}
                    {{ Form::label('titolo', 'titolo', ['class' => 'label-input']) }}
                    {{ Form::text('titolo', '', ['class' => 'input', 'id' => 'titolo']) }}
                    @if ($errors->first('titolo'))
                    <ul class="errors">
                        @foreach ($errors->get('titolo') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div class="wrap-input">
                {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                {{ Form::textarea('descrizione', '', ['class' => 'input descrizione', 'id' => 'descrizione']) }}
                @if ($errors->first('descrizione'))
                <ul class="errors">
                    @foreach ($errors->get('descrizione') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>


            <div class="container-form-btn">
                {{ Form::submit('crea', ['class' => 'my-button']) }}
            </div>



            {{ Form::close() }}
        </div>
    </div>

</div>



@endsection
