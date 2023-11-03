<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>
            <h1 class="text-white h1 ">CREAR COMANDA</h1>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card bg-gray-700 rounded-none">




        <div class="card-body bg-gray-300 rounded-none my-3 d-flex flex-wrap gap-2 ">

            @for ($i = 1; $i <= $zona->mesas; $i++)
                <a href="{{ route('comandas.create',  [$zona->id, $i]) }}">
                    <div class="card rounded-none">
                        <div class="card-body text-center">

                            <h5>Mesa</h5>
                            <h5 class="card-title text-xl">{{ $i }}</h5>
                        </div>
                    </div>
                </a>
            @endfor


        </div>
    </div>

</x-app-layout>
