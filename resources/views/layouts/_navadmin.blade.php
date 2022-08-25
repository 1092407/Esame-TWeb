<div class="w3-top">
    <div class="w3-bar" id="myNavbar">
        <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>

         <a href="{{route('admin')}}" class="w3-bar-item w3-button w3-hide-small" title="Torna alla tua home admin"><i class="fa fa-home"></i> HOME ADMIN</a>

        <a href="{{route('statistiche')}}" class="w3-bar-item w3-button w3-hide-small" title="vedi informazioni utili"><i class="fa fa-bar-chart"></i> Vedi statistiche </a>
      <a href="{{route('gestiscistaff')}}" class="w3-bar-item w3-button w3-hide-small" title="visualizza i  membri del tuo staff"><i class="fa fa-users"></i> Vedi il tuo  staff</a>
        <a href="{{route('registrastaff')}}" class="w3-bar-item w3-button w3-hide-small" title="aggiungi membri dello staff"><i class="fa fa-line-chart"></i>Incrementa il tuo staff</a>
    <a href="{{route('listablogs')}}" class="w3-bar-item w3-button w3-hide-small" title="controlla il contenuto dei blogs"><i class="fa fa-exclamation-triangle"></i>Controlla Blogs</a>

 <div class="w3-dropdown-click w3-right">
            <button  class=" w3-button w3-hide-small profileButton">
                <!--<img src="{{asset('img/right-arrow.png')}}" height="13px" width="13px" class="profile-name arrow " id="profile-arrow" >-->
                {{Auth::user()->name}} {{Auth::user()->cognome}}

            </button>

        </div>



        <!--Per motivi di sicurezza il logout va fatto in metodo post piuttosto che in metodo get, quindi non possiamo usare un ancora perchè essa invia in maniera fissa una richiesta al server in metodo GET
     -->

        <a href="" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red" title="Esci dal sito" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Logout</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

            {{ csrf_field() }}

        </form>


    </div>
</div>
