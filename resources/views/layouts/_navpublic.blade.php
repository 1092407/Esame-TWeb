<div class="w3-top">
    <div class="w3-bar" id="myNavbar">
        <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>

        @guest
        <a href="{{route('home')}}" class="w3-bar-item w3-button w3-hide-small" title="Torna all'inizio"><i class="fa fa-home"></i> HOME</a>
        <a href="{{route('register')}}" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red" title="Effettua la registrazione al sito"><i class="fa fa-vcard"></i> Registrati</a>
        <a href="{{route('login')}}" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red" title="Effettua l'accesso al sito"><i class="fa fa-sign-in"></i> Accedi</a>
        @endguest







        <a href="{{route('cosa')}}" class="w3-bar-item w3-button w3-hide-small" title="Cosa offriamo con blo"><i class="fa fa-info-circle"></i> Servizio</a>
        <a href="{{route('chi')}}" class="w3-bar-item w3-button w3-hide-small" title="scopri chi sono i creatori della comunità"><i class="fa fa-users"></i> Chi Siamo</a>
        <a href="{{route('dove')}}" class="w3-bar-item w3-button w3-hide-small" title="Dove trovarci"><i class="fa fa-map-marker"></i> Dove Trovarci</a>

        <a href="mailto:info@blo.it" class="w3-bar-item w3-button w3-hide-small" title="Mandaci un messaggio"><i class="fa fa-envelope"></i> Contattaci</a>

    </div>
</div>
