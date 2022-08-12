<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <title>blo | @yield('title', 'admin')</title>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @section('links')
        <link rel="stylesheet" type="text/css" href= "{{ asset('css/w3-style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--Da qui prendiamo le icone-->

<!--questo  aggiunto per fare delle prove, gio -->
@show
@section('scripts')
<script language="JavaScript" type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('js/form_validation.js') }}"></script>
<script>
$(function() {
    $(".alert").show().delay(2000).fadeOut("show");
  })
</script>
@show
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>

    </head>

    <body>
        <!-- Navbar (sit on top) -->
        @include('layouts/_navadmin')


        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
            <div class="w3-display-middle" style="white-space:nowrap;">
              <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">blo</span>
            </div>
            <div class="w3-display-middle" style="white-space:nowrap;">
              <span class="logo w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">BENTORNATO NELLA ZONA ADMIN </span>
            </div>
        </div>


        <div class="w3-content w3-padding" style="max-width:1654px">
            @yield('content')
        </div>


    </body>
</html>
