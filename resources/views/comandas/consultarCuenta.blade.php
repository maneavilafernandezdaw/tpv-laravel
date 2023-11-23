<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light  bg-primary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}>Inicio</a>
            <a class="navbar-brand text-2xl" href={{ route('comandas.cuenta') }}>Volver a zonas</a>
        </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h1 class=" h1 text-center mt-3"> {{ $zona->nombre }} - Mesa: {{ $mesa }}</h1>
    </div>


    <div class="container">
        <div class="row">
            {{-- tabla de pedido --}}
            <div class="col-sm-6">
                <h1 class=" h1 text-center mt-3">Cuenta</h1>
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

                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div>


            <div class="col-sm-6">
                <h1 class=" h1 text-center m-4">Total: {{ $total }}€ </h1>
               
                @if (isset($comanda) && Auth::user()->admin)
                    <div class="d-flex flex-wrap justify-center row">
                         {{-- botón efectivo --}}
                        <div class="col-lg-6 pb-2">
                            <form action="{{ route('cobros.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="mesa" name="mesa" value="{{ $mesa }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="cantidad" name="cantidad" value="{{ $total }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="tipo" name="tipo" value="Efectivo">
                                </div>

                                <x-boton-cobrar>
                                    {{ __('Efectivo') }}
                                </x-boton-cobrar>

                            </form>
                        </div>
                         {{-- botón tarjeta --}}
                        <div class="col-lg-6  pb-2">
                            <form action="{{ route('cobros.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="mesa" name="mesa" value="{{ $mesa }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="cantidad" name="cantidad" value="{{ $total }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="tipo" name="tipo" value="Tarjeta">
                                </div>

                                <x-boton-cobrar>
                                    {{ __('Tarjeta') }}
                                </x-boton-cobrar>

                            </form>
                        </div>
                     <!-- Button trigger modal Eliminar-->
                        <div class="col-lg-6 pb-2">
                   
                                <x-boton-eliminar-cuenta  data-bs-toggle="modal" data-bs-target="#modalEliminar">
                                    {{ __('Eliminar') }}
                                </x-boton-eliminar-cuenta>

                 
                            
                       
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
                                                    la cuenta {{ $zona->nombre }} - Mesa: {{ $mesa }}?</p>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('comandas.eliminarCuenta') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" id="mesa" name="mesa" value="{{ $mesa }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" id="zona_id" name="zona_id" value="{{ $zona->id }}">
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
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
