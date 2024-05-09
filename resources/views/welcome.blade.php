<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon-->
    <x-favicon-logo />

    <title>Minibar</title>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class=" font-sans h-screen">



    <div class="h-full w-full flex justify-center items-center flex-col gap-y-4">



        <div>
            <h1 class=" text-8xl text-center font-bold text-cyan-700">TPV</h1>
        </div>
        <figure class="flex justify-center">
            <img src="imagen/logoMinibar.jpeg" alt="imagen logo" class="w-3/4">
        </figure>


        @if (Route::has('login'))
            <div class="m-4">
                @auth


                    <a href="{{ url('/home') }}" ><x-boton-inicio class="scale-150"/></a>
                @else
                    <a href="{{ route('login') }}"><x-boton-iniciarSesion /></a>


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
