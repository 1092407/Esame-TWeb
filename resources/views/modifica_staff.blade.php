@extends('layouts.admin')
@section('title', 'Modifica staff')

@section('content')
@isset($staff)



<div class="static w3-center">
    <h2><b>ora modifichiamo lo  staff</b></h2>
    <p>Utilizza questa form per registrare i membri del tuo staff .</p>
    <hr>
    <div class="container-contact">
        <div class="wrap-contact1">

 {{ Form::open(array('route' => ['staff.update',$staff->id ], 'method' => 'PUT', 'id'=>'modificastaff', 'class' => 'animate')) }}

              {{ Form::label('name', 'Nome', ['class' => 'label-input-alloggio']) }}
                {{ Form::text('name',$staff->name, ['class' => 'text-input-alloggio', 'id' => 'name']) }}
                @if ($errors->first('name'))
                <ul class="errors">
                    @foreach ($errors->get('name') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif



                {{ Form::label('cognome', 'Cognome', ['class' => 'label-input']) }}
                {{ Form::text('cognome', $staff->cognome, ['class' => 'input', 'id' => 'surname']) }}
                @if ($errors->first('cognome'))
                <ul class="errors">
                    @foreach ($errors->get('cognome') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif

                 {{ Form::label('sesso', 'Sesso', ['class' => 'label-input']) }}
                    {{ Form::select('sesso',['Maschio'=>'Maschio', 'Femmina'=>'Femmina'], $staff->sesso, ['class' => 'input','id' => 'sesso', 'placeholder' => 'Seleziona il tuo sesso']) }}
                    @if ($errors->first('sesso'))
                    <ul class="errors">
                        @foreach ($errors->get('sesso') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif



                  {{ Form::label('data_nascita', 'Data di Nascita', ['class' => 'label-input']) }}
                    {{Form::date('data_nascita', \Carbon\Carbon::now(),$staff->data_nascita ,['class'=>'input']) }}

                    @if ($errors->first('data_nascita'))
                    <ul class="errors">
                        @foreach ($errors->get('data_nascita') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif

                     {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                    {{ Form::text('email', $staff->email, ['class' => 'input','id' => 'email']) }}
                    @if ($errors->first('email'))
                    <ul class="errors">
                        @foreach ($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif


          {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                {{ Form::text('username', $staff->username, ['class' => 'input','id' => 'username']) }}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif

                  {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                {{ Form::textarea('descrizione', $staff->descrizione, ['class' => 'input descrizione', 'id' => 'descrizione']) }}
                @if ($errors->first('descrizione'))
                <ul class="errors">
                    @foreach ($errors->get('descrizione') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif




                {{ Form::submit('Salva Modifica', ['class' => 'w3-button w3-right w3-blue' , 'style'=> "width:150px"]) }}
                {{Form::close()}}



        </div>
    </div>

</div>





@endisset
@endsection
