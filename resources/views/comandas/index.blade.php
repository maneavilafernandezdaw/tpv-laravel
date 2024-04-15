<x-app-layout>



    <div class="">
        <h1 class="text-center h1 mt-3">CREAR COMANDA</h1>
    </div>

    <nav>
        <div class=" flex justify-center">
            <a href={{ route('home') }}><x-boton-inicio /></a>

        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')



    <div class="container mt-3 card ">

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
                        <x-boton-zona-ocupada>
                            <div class="  text-center">
                                <h3 class="font-bold text-xl">{{ $zona->nombre }}</h3>
                                <h5>Nº de mesas:</h5>
                                <h5 class=" font-bold text-xl">{{ $zona->mesas }}</h5>
                            </div>
                        </x-boton-zona-ocupada>
                    </a>
                @else
     
                    <a href="{{ route('zonas.show', $zona->id) }}">
                        <x-boton-zona-libre>
                            <div class="  text-center">
                                <h3 class="font-bold text-xl">{{ $zona->nombre }}</h3>
                                <h5>Nº de mesas:</h5>
                                <h5 class=" font-bold text-xl">{{ $zona->mesas }}</h5>
                            </div>
                        </x-boton-zona-libre>
                    </a>
                @endif
            @endforeach


        </div>
    </div>

</x-app-layout>
