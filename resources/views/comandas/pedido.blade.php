<x-app-layout>


    <div class="d-flex justify-center gap-3 items-center my-3">
  
        <div class="d-flex  ">
            <div>
                <span class=" h1  text-center mt-2"> {{ $zona->nombre }}&nbsp;&nbsp; </span>
            </div>
            <div>
                <span class=" h1  text-center mt-2"> Mesa: {{ $mesa }}</span>
            </div>
        </div>

    </div>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')




    <div class="">
    
        <div class="d-flex justify-center">
            <a href={{ route('comandas.create', [$zona->id, $mesa, $familia]) }}>
             {{--    <x-boton-comanda class="d-block ">
                    {{ __('Volver a Productos') }}
                </x-boton-comanda></a> --}}
               {{--  <button type="submit" class="btn btn-outline-success rounded-none w-screen text-3xl p-3 mb-3 shadow">Volver a Productos</button> --}}
                <x-boton-volver/>
        </div>
    </div>




    {{-- tabla de pedido --}}
    <div >
        <div class="d-flex flex-col">
        <h3 class=" h2 text-center mt-2">Comanda</h3>
        <h1 class="text-center"><a href="{{ route('comandas.consultarCuenta', [$zona->id, $mesa]) }}"><x-boton-admin>Consultar cuenta</x-boton-admin></a></h1>
    </div>
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
                            @foreach ($todosProductos as $producto)
                                @if ($producto->id === $comanda->producto_id)
                                    {{ $producto->nombre }}
                                @endif
                            @endforeach
                            @if ($comanda->refresco !== 'Solo')
                                /{{ $comanda->refresco }}
                            @endif
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

                                    <x-boton-incrementar/>
                                
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

                                    <x-boton-decrementar/>
                                  
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
                                    <x-boton-enviar-comanda/>
                                  

                                </form>
                            </div>
                            <div>
                                                           <!--Botón Modal Eliminar-->
                            <x-boton-eliminar data-bs-toggle="modal" data-bs-target="#modalEliminar" />

                            <!-- Modal Eliminar-->
                            <div class="modal fade" id="modalEliminar" tabindex="-1"
                                aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-red-600">
                                            <h1 class="modal-title fs-5 text-white">Eliminar Cuenta
                                            </h1>

                                        </div>
                                        <div class="modal-body text-center">
                                            <div>
                                                <p>¿Está seguro de eliminar la
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
                                                <div class="form-group">
                                                    <input type="hidden" id="familia" name="familia"
                                                        value="{{ $familia }}">
                                                </div>
                                                <x-boton-eliminar />


                                            </form>

                                            @include('components.boton-cancelar')

                                        </div>
                                    </div>
                                </div>
                            </div>
                               

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
