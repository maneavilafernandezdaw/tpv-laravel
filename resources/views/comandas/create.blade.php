<x-app-layout>



    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h1 class=" h1 text-center mt-2"> {{ $zona->nombre }} - Mesa: {{ $mesa }}</h1>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-primary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}>Inicio</a>
            <a class="navbar-brand text-2xl" href={{ route('comandas.index') }}>Volver a zonas</a>
        </div>
    </nav>

    <div class=" row p-sm-4">

        {{-- productos para pedir --}}
        <div class="col-12  col-md-8">

            <div class="d-md-none">
                <!-- Button trigger modal Crear-->
                <div class="d-flex justify-center">
                    <a href={{ route('comandas.pedido', [$zona->id, $mesa]) }}><x-boton-comanda
                            class="d-block d-md-hidden">
                            {{ __('Ver Comanda') }}
                        </x-boton-comanda></a>
                </div>




            </div>

            @if (Auth::user()->admin)
            <h3 class=" h3 text-center mt-2">General</h3>

          
                <div class=" my-3 d-flex flex-wrap gap-2 justify-center">

                    @foreach ($general as $producto)
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
                                <div class="card  border border-primary h-24 w-24  align-middle">
                                    <div class="card-body  d-flex justify-center items-center p-0">

                                        @if ($producto->imagen)
                                            <img src="../../../imagen/{{ $producto->imagen }}" class=" h-24 w-24"
                                                alt="imagen producto">
                                        @else
                                            <h5 class="card-title  text-lg fw-bold text-center mb-0 ">
                                                {{ $producto->nombre }}
                                            </h5>
                                        @endif

                                    </div>
                                </div>
                            </button>
                        </form>
                    @endforeach

                </div>
            @endif
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
                            <div class="card border border-primary h-24 w-24  align-middle">
                                <div class="card-body  d-flex justify-center items-center p-0">

                                    @if ($producto->imagen)
                                        <img src="../../../imagen/{{ $producto->imagen }}" class=" h-24 w-24"
                                            alt="imagen producto">
                                    @else
                                        <h5 class="card-title  text-lg fw-bold text-center mb-0 ">
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
        <div class="hidden d-md-block col-md-4">
            <h3 class=" h3 text-center mt-2">Comanda</h3>
            <a class="btn btn-primary rou d-block text-4xl p-3 mb-3" href="{{ route('comandas.consultarCuenta', [$zona->id, $mesa]) }}">Consultar cuenta</a>
            <table class="table table-striped text-sm  border border-collapse">
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
                                @foreach ($general as $producto)
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

                                        <!--Botón Modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                            {{ __('Eliminar') }}
                                        </x-boton-eliminar>

                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Cuenta
                                                        </h1>

                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div>
                                                            <p class="text-black">¿Está seguro de eliminar la
                                                                la comanda {{ $zona->nombre }} - Mesa:
                                                                {{ $mesa }}?</p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <form action="{{ route('comandas.eliminarComanda') }}"
                                                            method="post">
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

                                                        @include('components.boton-cancelar')

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</x-app-layout>
