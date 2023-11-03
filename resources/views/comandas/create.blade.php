<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>

        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h2 class=" h2 text-center mt-2"> {{ $zona->nombre }} - Mesa: {{ $mesa }}</h2>
    </div>
    <div class=" row p-sm-4">

        {{-- productos para pedir --}}
        <div class="col-12 col-sm-8 col-md-9">
            <h3 class=" h3 text-center mt-2">Productos</h3>
            <div class=" my-3 d-flex flex-wrap gap-2 justify-center">

                @foreach ($productos as $producto)
                    <form action="{{ route('comandas.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="mesa" name="mesa" value="{{ $mesa }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="producto_id" name="producto_id" value="{{ $producto->id }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="cantidad" name="cantidad" value="1">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="estado" name="estado" value="No enviado">
                        </div>

                        <button type="submit">
                            <div class="card rounded-none  h-20 w-20  align-middle ">
                                <div class="card-body  d-flex justify-center items-center p-0">

                                    @if ($producto->imagen)
                                        <img src="../../../imagen/{{ $producto->imagen }}" class=" h-20 w-20"
                                            alt="imagen producto">
                                    @else
                                        <h5 class="card-title  text-xl fw-bold text-center mb-0">
                                            {{ $producto->nombre }}
                                        </h5>
                                    @endif

                                </div>
                            </div>
                        </button>
                    </form>
                @endforeach

            </div>
        </div>

        {{-- tabla de pedido --}}
        <div class="col-12 col-sm-4 col-md-3 ">
            <h3 class=" h3 text-center mt-2">Pedido</h3>
            <table class="table table-striped text-sm">
                <thead>
                    <tr>
                        <th scope="col">Cant.</th>
                        <th scope="col">Nombre</th>
<th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comandas as $comanda)
                        <tr>
                            <td>{{ $comanda->cantidad }}</td>
                            <td>
                                @foreach ($productos as $producto)
                                    @if ($producto->id === $comanda->producto_id)
                                        {{ $producto->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-center">
                                <form action="{{ route('comandas.incrementar') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" id="mesa" name="mesa"
                                            value="{{ $mesa }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="zona_id" name="zona_id"
                                            value="{{ $zona->id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="comanda_id" name="comanda_id"
                                            value="{{ $comanda->id }}">
                                    </div>

                                    <x-boton-incrementar>
                                        {{ __('+') }}
                                    </x-boton-incrementar>
                                </form>

                                <form action="{{ route('comandas.decrementar') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" id="mesa" name="mesa"
                                            value="{{ $mesa }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="zona_id" name="zona_id"
                                            value="{{ $zona->id }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="comanda_id" name="comanda_id"
                                            value="{{ $comanda->id }}">
                                    </div>
                   
                                    <x-boton-decrementar>
                                        {{ __('-') }}
                                    </x-boton-decrementar>
                                </form>
                            </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

    </div>

</x-app-layout>
