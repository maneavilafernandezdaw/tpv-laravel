<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TPV-Laravel</title>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

 <!-- Scripts -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg">



    <div class="container h-full vh-100 d-flex flex-col justify-center items-center gap-3">
       
            
        <div class="d-flex flex-col items-center">
            <h1 class="fw-bold display-2 text-center m-2">TPV Minibar</h1>
            <img src="imagen/logoMinibar.jpeg" alt="imagen logo" class="w-3/4">
        </div>
    
    @if (Route::has('login'))
        <div class="">
            @auth


                <a href="{{ url('/home') }}"><x-boton-inicio/></a>
            @else
                <a href="{{ route('login') }}"><x-boton-iniciarSesion/>
                  

            @endauth
        </div>
    @endif

</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</body>

</html>
