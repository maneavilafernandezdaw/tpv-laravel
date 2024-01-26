<x-app-layout>



    <div class="container-fluid">
        <h1 class="text-center h1 mt-3">CREAR COMANDA</h1>
    </div>

    <nav>
        <div class="container-fluid d-flex justify-center">
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-admin>Inicio</x-boton-admin></a>

        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')



    <div class="container mt-3 card  rounded-none">

        <h1 class="h1 text-center mt-3">ZONAS</h1>


        <div class="card-body  my-3 d-flex gap-3 flex-wrap justify-center">
     
            @foreach ($zonas as $zona)
             @php
                        $ocupada = 0;
                    @endphp
                @foreach ($comandas as $comanda)
                   
                    @if ($comanda->zona_id === $zona->id)
                        @php
                            $ocupada = 1;
                        @endphp
                    @endif
               @endforeach
                @if ($ocupada > 0)
                    <a href="{{ route('zonas.show', $zona->id) }}">
                        <div class="card border border-danger border-2 shadow">
                            <div class="card-body  text-center">
                                <h3 class="card-title fw-bold text-xl">{{ $zona->nombre }}</h3>
                                <h5>Nº de mesas:</h5>
                                <h5 class="card-title text-xl">{{ $zona->mesas }}</h5>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ route('zonas.show', $zona->id) }}">
                        <div class="card border border-primary border-2 shadow">
                            <div class="card-body  text-center">
                                <h3 class="card-title fw-bold text-xl">{{ $zona->nombre }}</h3>
                                <h5>Nº de mesas:</h5>
                                <h5 class="card-title text-xl">{{ $zona->mesas }}</h5>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach

 
        </div>
    </div>

</x-app-layout>
