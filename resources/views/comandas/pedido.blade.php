<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>
            <a class="navbar-brand h1 text-white" href={{ route('comandas.index') }}>Volver a Zonas</a>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h2 class=" h2 text-center mt-2"> {{ $zona->nombre }} - Mesa: {{ $mesa }}</h2>
    </div>



    <div class="d-md-none">
        <!-- Button trigger modal Crear-->
        <div class="d-flex justify-center">
            <a href={{ route('comandas.create', [$zona->id, $mesa]) }}>
                <x-boton-comanda class="d-block d-md-hidden">
                    {{ __('Volver a Productos') }}
                </x-boton-comanda></a>
        </div>
    </div>




    {{-- tabla de pedido --}}
    <div class=" ">
        <h3 class=" h3 text-center mt-2">Comanda</h3>
        <table class="table table-striped text-sm">
            <thead>
                <tr>
                    <th scope="col">Cant.</th>
                    <th scope="col">Producto</th>
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
                                <form action="{{ route('comandas.incrementarTabla') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" id="mesa" name="mesa" value="{{ $mesa }}">
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

                                <form action="{{ route('comandas.decrementarTabla') }}" method="post">
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
                <tr>
                    <td colspan="3">
                        @if (isset($comanda))
                        <div class="d-flex gap-3 justify-center">
                            <div>
                                <form action="{{ route('comandas.enviar') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" id="mesa" name="mesa"
                                            value="{{ $mesa }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="zona_id" name="zona_id"
                                            value="{{ $zona->id }}">
                                    </div>
                                    <x-boton-enviar-comanda>
                                        {{ __('Enviar') }}
                                    </x-boton-enviar-comanda>

                                </form>
                            </div>
                            <div>
                                <form action="{{ route('comandas.eliminarComanda') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" id="mesa" name="mesa"
                                            value="{{ $mesa }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="zona_id" name="zona_id"
                                            value="{{ $zona->id }}">
                                    </div>
                                    <x-boton-eliminar>
                                        {{ __('Eliminar') }}
                                    </x-boton-eliminar>

                                </form>
                            </div>
                        </div>
                    @endif
                    </td>
                </tr>
            </tbody>
        </table>

    </div>




</x-app-layout>
