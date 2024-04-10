<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
     <!-- Favicon-->
     <x-favicon-logo/>

    <title>{{ config('app.name', 'TPV-Laravel') }}</title>

        {{-- script jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    {{-- bootstrap --}}
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- Scripts -->
   
    {{-- <link href="{{ asset('/bootstrap.css') }}" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ConectorJavaScript.js'])
</head>

<body class="font-sans antialiased m-0 h-0 w-100 " data-bs-theme ={{ request()->cookie('tema') }} >
    <div id="loading" style="display: none;">
        <div class="container-fluid d-flex justify-content-center align-items-center " style="height: 100vh; ">
            <span class="h2">Cargando...</span>
            <img src="imagen/cargando.gif" alt="Cargando..." />
        </div>
    </div>
    <div class=" ">
        {{-- nav --}}
        @include('layouts.navigation')
       
        <!-- Contenido de la página -->
        <main class="m-0 p-0">
            {{ $slot }}
        </main>
    </div>
    {{-- script jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    {{-- script bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
  
    {{-- script datatables --}}
    <script src=" https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


</body>

</html>
