<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>
            <a class="navbar-brand h1 text-white" href={{ route('comandas.index') }}>Volver a Zonas</a>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card bg-gray-700 rounded-none">

        <h1 class="text-white h1 text-center mt-2">{{ $zona->nombre }}</h1>


        <div class="card-body bg-gray-300 rounded-none my-2 d-flex flex-wrap gap-2 justify-center">

            @for ($i = 1; $i <= $zona->mesas; $i++)
                @php
                    $ocupada = 0;
                @endphp

                <a href="{{ route('comandas.create', [$zona->id, $i]) }}">

                    @foreach ($comandas as $comanda)
                        @if ($comanda->mesa == $i && $comanda->zona_id === $zona->id)
                            @php
                                $ocupada = 1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($ocupada > 0)
                        <div class="card rounded-none ">
                            <div class="card-body text-center bg-red-500">
                                <h5>Mesa</h5>
                                <h5 class="card-title text-xl ">{{ $i }}</h5>
                            @else
                                <div class="card rounded-none">
                                    <div class="card-body text-center bg-green-500">
                                        <h5>Mesa</h5>
                                        <h5 class="card-title text-xl">{{ $i }}</h5>
                    @endif



        </div>
    </div>
    </a>
    @endfor


    </div>
    </div>

</x-app-layout>
