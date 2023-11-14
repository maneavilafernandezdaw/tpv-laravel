<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand h1 text-white" href={{ route('home') }}>Inicio</a>
            <a class="navbar-brand h1 text-white" href={{ route('comandas.cuenta') }}>Volver</a>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h2 class=" h2 text-center mt-2"> {{ $zona->nombre }} - Mesa: {{ $mesa }}</h2>
    </div>



    <div class="container">

        {{-- tabla de pedido --}}
        <div class="col-sm-6">
            <h3 class=" h3 text-center mt-2">Cuenta</h3>
            <table class="table table-striped text-sm">
                <thead>
                    <tr>
                        <th scope="col">Cant.</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($comandas as $comanda)
                        <tr>
                            <td class="ps-3">{{ $comanda->cantidad }}</td>

                            @foreach ($productos as $producto)
                                @if ($producto->id === $comanda->producto_id)
                                    <td>{{ $producto->nombre }} </td>
                                    <td>{{ $producto->precio }}€ </td>
                                    <td class="text-center">{{ $producto->precio * $comanda->cantidad }}€ </td>
                                    @php
                                        $total += $producto->precio * $comanda->cantidad;
                                    @endphp
                                @endif
                            @endforeach



                        </tr>
                    @endforeach
                    <tr>
                      
                        <th colspan="4" class="text-2xl text-right">Total: {{ $total }}€</th>
                    
                    </tr>
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
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </div>
      
    </div>


</x-app-layout>
