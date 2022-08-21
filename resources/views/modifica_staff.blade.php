
@extends('layouts.admin')
@section('title', 'Modifica staff')

@section('content')
@isset($staff)


<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:30px">

  <!-- Header -->
  <header id="portfolio">
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
      <h1 id="titolo" style="margin-bottom:0px;"><b>Gestione staff</b></h1>
      <div class=" w3-bottombar w3-padding-16" style="margin-bottom:16px;">
      </div>
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
    <div class="w3-container" align='center'>
    <div class="w3-modal-content w3-animate-zoom">
        <div class="w3-container  w3-blue">
            <h2>Qui modifichi i dati di un membro staff</h2>
        </div>
        <div class="w3-panel" style="padding-bottom:16px;">
            <div align='center'>
                {{ Form::open(array('route' => ['staff.update', ($staff[0])], 'method' => 'PUT', 'id'=>'modificastaff', 'class' => 'animate')) }}

              <div class="wrap-input">
                    {{ Form::label('', '', ['class' => ' fa fa-id-card-o']) }}
                    {{ Form::label('name', 'Nome', ['class' => 'label-input']) }}
                    {{ Form::text('name',   $staff[1]  , ['class' => 'input', 'id' => 'name']) }}
                    @if ($errors->first('name'))
                    <ul class="errors">
                        @foreach ($errors->get('name') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

<div class="wrap-input">
                    {{ Form::label('', '', ['class' => 'fa fa-id-card-o']) }}
                    {{ Form::label('cognome', 'Cognome', ['class' => 'label-input ']) }}
                    {{ Form::text('cognome', $staff[2], ['class' => 'input', 'id' => 'surname']) }}
                    @if ($errors->first('cognome'))
                    <ul class="errors">
                        @foreach ($errors->get('cognome') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

 <div class="wrap-input">
                    {{ Form::label('', '', ['class' => 'fa fa-venus-mars']) }}
                    {{ Form::label('sesso', 'Sesso', ['class' => 'label-input']) }}
                    {{ Form::select('sesso',['Maschio'=>'Maschio', 'Femmina'=>'Femmina'], $staff[3], ['class' => 'input','id' => 'sesso', 'placeholder' => 'Seleziona il tuo sesso']) }}
                    @if ($errors->first('sesso'))
                    <ul class="errors">
                        @foreach ($errors->get('sesso') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

<div class="wrap-input">
                    {{ Form::label('', '', ['class' => 'fa fa-birthday-cake']) }}
                    {{ Form::label('data_nascita', 'Data di Nascita', ['class' => 'label-input']) }}
                    {{Form::date('data_nascita', $staff[4],['class'=>'input'])}}

                    @if ($errors->first('data_nascita'))
                    <ul class="errors">
                        @foreach ($errors->get('data_nascita') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

<div class="wrap-input">
                    {{ Form::label('', '', ['class' => 'fa fa-envelope']) }}
                    {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                    {{ Form::text('email', $staff[5], ['class' => 'input','id' => 'email']) }}
                    @if ($errors->first('email'))
                    <ul class="errors">
                        @foreach ($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

<div class="wrap-input">
                {{ Form::label('', '', ['class' => 'fa fa-user']) }}
                {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                {{ Form::text('username', $staff[6], ['class' => 'input','id' => 'username']) }}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

<div class="wrap-input">
                {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                {{ Form::textarea('descrizione', $staff[7], ['class' => 'input descrizione', 'id' => 'descrizione']) }}
                @if ($errors->first('descrizione'))
                <ul class="errors">
                    @foreach ($errors->get('descrizione') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>



                {{ Form::submit('Salva Modifica', ['class' => 'w3-button w3-right w3-blue' , 'style'=> "width:150px"]) }}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>


@endisset
@endsection
