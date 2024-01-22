<x-app-layout>



    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    <div>
        <h1 class=" h1 text-center mt-3"> {{ $zona->nombre }} - Mesa: {{ $mesa }}</h1>
    </div>

    <nav>
        <div class="container-fluid d-flex justify-center gap-2">
            <a href={{ route('home') }}><x-boton-admin>Inicio</x-boton-admin></a>
            <a href="{{ route('comandas.create', [$zona->id, $mesa]) }}"><x-boton-admin>Volver</x-boton-admin></a>

        </div>
    </nav>

    <div class="container">
        <div class="row">
            {{-- tabla de pedido --}}
            <div class="col-sm-6">
                <h1 class=" h2 text-center ">Cuenta</h1>
                @if ( Auth::user()->admin)
                <div class="text-center">
                    <form action="{{ route('comandas.imprimirCuenta') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="mesa" name="mesa"
                                value="{{ $mesa }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="zona_id" name="zona_id"
                                value="{{ $zona->id }}">
                        </div>
                        <x-boton-cobrar>
                            {{ __('Imprimir') }}
                        </x-boton-cobrar>

                    </form>
                </div>
                @endif
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
                            $subtotal = 0;
                        @endphp
                        @foreach ($comandas as $comanda)
                            <tr>
                                <td class="ps-3">{{ $comanda->cantidad }}</td>

                                @foreach ($productos as $producto)
                                    @if ($producto->id === $comanda->producto_id)
                                        <td>{{ $producto->nombre }} </td>
                                        <td>{{ $producto->precio }}€ </td>
                                        @php
                                        $subtotal =number_format($comanda->cantidad*$producto->precio, 2, '.', '');
                                        @endphp
                                        <td class="text-center">{{ $subtotal }}€ </td>
                                        @php
                                            $total += $producto->precio * $comanda->cantidad;
                                        @endphp
                                    @endif
                                @endforeach



                            </tr>
                        @endforeach
                        <tr>
                            @php
                            $total = number_format($total, 2, '.', '');
                        @endphp
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
                <h1 class=" h2 text-center ">Total: {{ $total }}€ </h1>

                @if (isset($comanda) && Auth::user()->admin)
                    <div class="d-flex flex-col items-center row">
                        {{-- botón efectivo --}}
                        <div class="col-lg-8 pb-2 ">
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
                        <div class="col-lg-8  pb-2">
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
                        {{-- botón bizum --}}
                        <div class="col-lg-8 pb-2 ">
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
                                    <input type="hidden" id="tipo" name="tipo" value="Bizum">
                                </div>

                                <x-boton-cobrar>
                                    {{ __('Bizum') }}
                                </x-boton-cobrar>

                            </form>
                        </div>



       


                        <!-- Button trigger modal Eliminar-->
                        <div class="col-lg-8 pb-2">

                            <x-boton-eliminar-cuenta data-bs-toggle="modal" data-bs-target="#modalEliminar">
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

                         <!-- Button trigger modal Facturar-->
                         <div class="col-lg-8 pb-2">

                            <x-boton-cobrar data-bs-toggle="modal" data-bs-target="#modalFacturar" >
                                {{ __('Factura') }}
                            </x-boton-cobrar>




                            <!-- Modal Eliminar-->
                            <div class="modal fade" id="modalFacturar" tabindex="-1"
                                aria-labelledby="modalFacturarLabel" aria-hidden="true">
                                <div class="modal-dialog text-black">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-success">
                                            <h1 class="modal-title fs-5 text-white">Crear Factura y Enviar
                                            </h1>

                                        </div>
                                        <div class="modal-body text-center">
                                             {{-- botón factura --}}
                        <div class=" ">
                            <form action="{{ route('cobros.descargar') }}" method="post" id="facturar">
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
                                    <input type="hidden" id="tipo" name="tipo" value="Bizum">
                                </div>
                              
                             
                                <label for="cliente">Cliente</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="cliente" name="cliente" required>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <x-boton-facturar onclick="mostrarFormulario()" class="w-full">
                                    {{ __('Facturar') }}
                                </x-boton-facturar>
                                
                                

                            </form>
<br>
                            @include('components.boton-salir')
                  
                        </div>
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
    <script>
        function mostrarFormulario() {
          // Oculta todos los formularios
          $('#facturar').addClass('d-none');
    
          // Muestra el formulario correspondiente al ID proporcionado
          $('#enviarFactura').removeClass('d-none');
          
        }
        function ocultarFormulario() {
      
    
        
          $('#enviarFactura').addClass('d-none');
          
        }
      </script>
</x-app-layout>
