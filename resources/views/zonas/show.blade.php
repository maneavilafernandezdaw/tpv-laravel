<x-app-layout>


    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h1 class=" h1 text-center  mt-2">Crear Comanda</h1>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}>Inicio</a>
            <a class="navbar-brand text-2xl" href={{ route('comandas.index') }}>Volver</a>
        </div>
    </nav>

    <div class="container mt-3 card  rounded-none">

        <h1 class=" h1 text-center mt-2">Mesas: {{ $zona->nombre }}</h1>


        <div class="card-body rounded-none my-2 d-flex flex-wrap gap-3 justify-center">



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
                        <div class="card w-24 h-24 border border-danger border-2 position-relative">
                            <div class="position-absolute top-50 start-50 translate-middle  fw-bold text-danger">

                                <h5 class=" text-3xl  text-center">{{ $i }}</h5>
                            @else
                                <div class="card w-24 h-24 border border-primary border-2 position-relative">
                                    <div
                                        class="position-absolute top-50 start-50 translate-middle  fw-bold text-primary">

                                        <h5 class=" text-3xl  text-center">{{ $i }}</h5>
                    @endif



        </div>
    </div>
    </a>
    @endfor


    </div>
    </div>

</x-app-layout>
