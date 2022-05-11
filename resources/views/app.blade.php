<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Maniobras') }}</title>

      <!-- JQUERY -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- Boostrap YA LO TRAE POR DEFECTO -->
      <!-- AJAX -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <!-- Locales -->
      <link rel="stylesheet" href="{{ asset('css/pestanas.css') }}" />

      <link rel="stylesheet" href="{{ asset('css/mapa.css') }}" />
      <!--WebSocket Pusher -->
      <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @routes

        <script async src="https://maps.googleapis.com/maps/api/js?callback=initMap" defer></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
         <script type="text/javascript" src="{{ asset('js/pestanas.js')}}"></script>
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        @env ('local')
            {{-- <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script> --}}
        @endenv
    </body>
   <!--SCRIPT AJAX-->
  <script src="{{asset('js/maniobras.js')}}" defer></script>
   <!--SCRIPT WebSocket-->
   <script src="{{asset('js/websocket.js')}}" defer></script>
   <!--SCRIPT MAPA-->
   <script src="{{asset('js/coordenadas.js')}}"></script>
</html>
