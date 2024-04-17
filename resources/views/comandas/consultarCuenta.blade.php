<x-app-layout>



    {{-- session mensaje  --}}
    @include('partials.session-mensaje')
    
<div class="container-fluid">
    <div class="d-flex justify-center gap-3 items-center mt-3">
        <div>
            <a class="navbar-brand text-2xl" href={{ route('home') }}><x-boton-inicio /></a>
        </div>
        <div class="d-flex flex-col flex-md-row">
            <div>
                <span class=" h2  text-center mt-2"> {{ $zona->nombre }}&nbsp;&nbsp; </span>
            </div>
            <div>
                <span class=" h2  text-center mt-2"> Mesa: {{ $mesa }}</span>
            </div>
        </div>
        <div>
            <a href="{{ route('comandas.create', [$zona->id, $mesa, 'todo']) }}"><x-boton-volver /></a>
        </div>
    </div>


 @if (count($comandas)>0)
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-6">
               
                @if (Auth::user()->admin)
                    
					<div class="container-fluid d-flex justify-center gap-3">
                        {{-- Boton imprimir cuenta --}}
                      <div class="text-center col-6">
                        <a href="{{ route('comandas.ticketCuenta', [$zona->id, $mesa, Auth::user()->name]) }}">
                            <x-boton-facturar >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                                  </svg>
                            </x-boton-facturar>
                            </a>
                     	</div>
                       <!-- Button trigger modal Facturar-->
  						<div class="text-center col-6">
                            <x-boton-facturar data-bs-toggle="modal" data-bs-target="#modalFacturar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                    <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z"/>
                                    <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                                  </svg>
                            </x-boton-facturar>
                     	</div>
                    </div>
              
                @endif

               
               <h1 class=" h2 text-center ">Cuenta</h1>
                {{-- tabla de pedido --}}
                <table class="table table-striped  text-sm">
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
                                        <td>{{ $producto->nombre }}  @if ($comanda->refresco !== "Solo")
                                            /{{ $comanda->refresco }}
                                            @endif</td>
                                        <td>{{ $comanda->precio }}€ </td>
                                        @php
                                            $subtotal = number_format($comanda->cantidad * $comanda->precio, 2, '.', '');
                                        @endphp
                                        <td class="text-center">{{ $subtotal }}€ </td>
                                        @php
                                            $total += $comanda->precio * $comanda->cantidad;
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                        <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                        <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                        <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                      </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                      </svg>
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

                            <x-boton-eliminar-cuenta data-bs-toggle="modal" data-bs-target="#modalEliminar" />

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

                                                <x-boton-eliminar />

                                            </form>

                                            @include('components.boton-cancelar')

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 pb-2">



                            <!-- Modal Facturar-->
                            <div class="modal fade" id="modalFacturar" tabindex="-1"
                                aria-labelledby="modalFacturarLabel" aria-hidden="true">
                                <div class="modal-dialog text-black">
                                    <div class="modal-content">
                                        <div class="modal-header  text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br">
                                            <h1 class="modal-title fs-5">Crear Factura y Enviar
                                            </h1>

                                        </div>
                                        <div class="modal-body text-center">

                                            <div>
                                                {{-- formulario --}}
                                                <form action="{{ route('factura.descargar') }}" method="post"
                                                    id="facturar">
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
                                                        <input type="hidden" id="cantidad" name="cantidad"
                                                            value="{{ $total }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" id="tipo" name="tipo"
                                                            value="Bizum">
                                                    </div>


                                                    <label for="cliente" class="text-xl font-medium">Cliente</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="cliente" name="cliente" required>
                                                        @foreach ($clientes as $cliente)
                                                            <option value="{{ $cliente->id }}">
                                                                {{ $cliente->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    {{-- Botón facturar --}}
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
  
 @else
  
  <h1 class="h1  text-center ">No hay comandas enviadas.</h1>
  
@endif
    <script>
        function mostrarFormulario() {
            // Oculta formulario
            $('.fade').addClass('d-none');
        }

    </script>
</x-app-layout>
