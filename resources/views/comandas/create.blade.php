<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>

        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h1 class=" h1 text-center mt-2">Zona: {{ $zona->nombre }} Mesa: {{ $mesa }}</h1>
    </div>
    <div class="container mt-2 card bg-gray-700 rounded-none">




        <div class="card-body bg-gray-300 rounded-none my-3 d-flex flex-wrap gap-2 justify-center">

            @foreach ($productos as $producto)
                <a href="{{ route('comandas.store') }}">
                    <div class="card  h-20 w-20  align-middle ">
                        <div class="card-body  d-flex justify-center items-center p-0">

                            @if ($producto->imagen)
                                <img src="../../../imagen/{{ $producto->imagen }}" class=" rounded-lg h-20 w-20"
                                    alt="imagen producto">
                            @else
                                <h5 class="card-title  text-xl fw-bold text-center mb-0">{{ $producto->nombre }}</h5>
                            @endif

                        </div>
                    </div>
                </a>
            @endforeach


        </div>
    </div>

</x-app-layout>
