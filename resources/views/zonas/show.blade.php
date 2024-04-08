<x-app-layout>


    {{-- session mensaje  --}}
    @include('partials.session-mensaje')


    <div class="container px-4 d-flex justify-center gap-4 items-center mt-2">
        <div>
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-inicio /></a>
        </div>
        <div class="d-flex flex-col flex-md-row">
            <div>
                <span class=" h1  text-center mt-2"> {{ $zona->nombre }} </span>
            </div>
        </div>
        <div>
            <a class="navbar-brand text-2xl" href={{ route('comandas.index') }}><x-boton-volver /></a>
        </div>
    </div>



    <div class="container mt-3 card ">
        <div class="card-body  my-2 d-flex flex-wrap gap-3 justify-center">
            @for ($i = 1; $i <= $zona->mesas; $i++)
                @php
                    $ocupada = 0;
                    $f = 'todo';
                @endphp

                <a href="{{ route('comandas.create', [$zona->id, $i, $f]) }}">

                    @foreach ($comandas as $comanda)
                        @if ($comanda->mesa == $i && $comanda->zona_id === $zona->id)
                            @php
                                $ocupada = 1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($ocupada > 0)
                        <div class="card w-24 h-24 border border-danger border-2 position-relative">
                            <div class="position-absolute top-50 start-50 translate-middle  fw-bold text-danger">

                                <h5 class=" text-3xl  text-center">{{ $i }}</h5>
                            </div>
                        </div>
                    @else
                        <div class="card w-24 h-24 border border-primary border-2 position-relative">
                            <div class="position-absolute top-50 start-50 translate-middle  fw-bold text-primary">

                                <h5 class=" text-3xl  text-center">{{ $i }}</h5>
                            </div>
                        </div>
                    @endif

                </a>
            @endfor
        </div>



    </div>
    

</x-app-layout>
