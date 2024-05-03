<x-app-layout class="w-full">



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
                <a class="navbar-brand text-2xl" href={{ route('comandas.index') }}><x-boton-volver /></a>
            </div>
        </div>
        {{-- boton ver comanda --}}
        <div class="d-md-none w-full">

            <div class="m-2 d-flex justify-center">
                <a href={{ route('comandas.pedido', [$zona->id, $mesa, $familia]) }}><x-boton-admin>
                        {{ __('Ver Comanda') }}
                    </x-boton-admin></a>
            </div>

        </div>
        <hr class="m-2">


        <div class=" row p-sm-4">

            {{-- productos para pedir --}}
            <div class="col-12  col-md-8">



                <div class=" d-flex flex-wrap gap-2 justify-center">
                    <ul class="nav nav-pills nav-stacked">
                        <div class="mb-2 d-flex flex-wrap gap-2 justify-center">

                            @if ($familia === 'todo')
                                <li><a
                                        href="{{ route('comandas.create', [$zona->id, $mesa, 'todo']) }}"><x-boton-checked>todo</x-boton-checked></a>
                                </li>
                            @else
                                <li><a
                                        href="{{ route('comandas.create', [$zona->id, $mesa, 'todo']) }}"><x-boton-admin>todo</x-boton-admin></a>
                                </li>
                            @endif


                            @foreach ($familias as $fam)
                                @if ($familia == $fam->id)
                                    <li><a
                                            href="{{ route('comandas.create', [$zona->id, $mesa, $fam->id]) }}"><x-boton-checked>{{ $fam->nombre }}</x-boton-checked></a>
                                    </li>
                                @else
                                    <li><a
                                            href="{{ route('comandas.create', [$zona->id, $mesa, $fam->id]) }}"><x-boton-admin>{{ $fam->nombre }}</x-boton-admin></a>
                                    </li>
                                @endif
                            @endforeach
                        </div>
                    </ul>
                </div>

                <div class=" d-flex flex-wrap gap-2 justify-center">

                    @foreach ($productos as $producto)
                        @foreach ($familias as $fam)
                            @if ($producto->familia_id == $fam->id)
                                @if ($fam->combinada)
                                    <div>


                                        <!-- Button trigger modal Combinar-->

                                        <button data-bs-toggle="modal"
                                            data-bs-target="#modalCombinar{{ $producto->id }}"
                                            class="max-w-sm w-24 h-24  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center text-cyan-700 font-bold text-lg flex justify-center items-center border-3 border-cyan-600 bg-cyan-100  hover:scale-110">

                                            <div class=" container px-0 break-words ...">
                                                {{ $producto->nombre }}
                                            </div>

                                        </button>



                                        <!-- Modal Combinar-->
                                        <div class="modal fade" id="modalCombinar{{ $producto->id }}" tabindex="-1"
                                            aria-labelledby="modalCombinarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue-600">
                                                        <h1 class="modal-title fs-5 text-white" id="modalCombinarLabel">
                                                            Combinar con:
                                                        </h1>
                                                        @include('components.boton-cancelar-mini')
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class=" d-flex flex-wrap gap-2 justify-center">
                                                            <form action="{{ route('comandas.store') }}" method="post"
                                                                enctype="multipart/form-data">
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
                                                                    <input type="hidden" id="producto_id"
                                                                        name="producto_id" value="{{ $producto->id }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="refresco" name="refresco"
                                                                        value="Solo">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="cantidad" name="cantidad"
                                                                        value="1">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="precio" name="precio"
                                                                        value="{{ $producto->precio }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="estado" name="estado"
                                                                        value="No enviado">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="familia" name="familia"
                                                                        value="{{ $familia }}">
                                                                </div>

                                                                <button type="submit"
                                                                    class="max-w-sm w-24 h-24 break-words  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center text-cyan-700 font-bold text-lg flex justify-center items-center border-3 border-cyan-600 bg-cyan-100  hover:scale-110">


                                                                    Solo

                                                                </button>
                                                            </form>


                                                            @foreach ($refrescos as $refresco)
                                                                <form action="{{ route('comandas.store') }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="mesa"
                                                                            name="mesa" value="{{ $mesa }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="zona_id"
                                                                            name="zona_id" value="{{ $zona->id }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="producto_id"
                                                                            name="producto_id"
                                                                            value="{{ $producto->id }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="refresco"
                                                                            name="refresco"
                                                                            value="{{ $refresco->nombre }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="cantidad"
                                                                            name="cantidad" value="1">
                                                                    </div>

                                                                    @foreach ($productos as $prod)
                                                                        @php
                                                                            $precio = 0;
                                                                        @endphp
                                                                        @if ($prod->id === $producto->id)
                                                                            @php
                                                                                $precio =
                                                                                    $prod->precio + $refresco->precio;

                                                                            @endphp
                                                                        @break
                                                                    @endif
                                                                @endforeach

                                                                <div class="form-group">
                                                                    <input type="hidden" id="precio"
                                                                        name="precio"
                                                                        value="{{ $precio }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="estado"
                                                                        name="estado" value="No enviado">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="familia"
                                                                        name="familia"
                                                                        value="{{ $familia }}">
                                                                </div>

                                                                <button type="submit"
                                                                    class="max-w-sm w-24 h-24 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center text-cyan-700 font-bold text-lg flex justify-center items-center border-3 border-cyan-600 bg-cyan-100  hover:scale-110">

                                                                    <div class=" container px-0 break-words ...">
                                                                        {{ $refresco->nombre }}
                                                                    </div>

                                                                </button>
                                                            </form>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">



                                                    @include('components.boton-cancelar')

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                        @else
                            <form action="{{ route('comandas.store') }}" method="post"
                                enctype="multipart/form-data">
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
                                    <input type="hidden" id="producto_id" name="producto_id"
                                        value="{{ $producto->id }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="refresco" name="refresco" value="Solo">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="cantidad" name="cantidad" value="1">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="precio" name="precio"
                                        value="{{ $producto->precio }}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="estado" name="estado" value="No enviado">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="familia" name="familia"
                                        value="{{ $familia }}">
                                </div>

                                <button type="submit"
                                    class="max-w-sm w-24 h-24  rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center text-cyan-700 font-bold text-lg flex justify-center items-center border-3 border-cyan-600 bg-cyan-100  hover:scale-110">

                                    <div class=" container px-0 break-words ...">
                                        {{ $producto->nombre }}
                                    </div>

                                </button>

                            </form>
                        @break

                    @endif


                @endif
            @endforeach
        @endforeach

    </div>
</div>


<aside class="hidden d-md-block col-md-4">

    {{-- boton consultar cuenta --}}
    <a href="{{ route('comandas.consultarCuenta', [$zona->id, $mesa]) }}">
        <x-boton-consultar>
            {{ __('Consultar cuenta') }}
        </x-boton-consultar></a>

    {{-- tabla de pedido --}}
    <div id="tablaComanda">
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
                        <td class="align-middle">{{ $comanda->cantidad }}</td>
                        <td class="align-middle">
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
                                {{-- boton incrementar --}}
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
                                    <div class="form-group">
                                        <input type="hidden" id="familia" name="familia"
                                            value="{{ $familia }}">
                                    </div>

                                    <x-boton-incrementar />

                                </form>
                                {{-- boton decrementar --}}
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
                                    <div class="form-group">
                                        <input type="hidden" id="familia" name="familia"
                                            value="{{ $familia }}">
                                    </div>

                                    <x-boton-decrementar />

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
                                    {{-- boton enviar --}}
                                    <div>
                                        {{-- boton enviar --}}
                                        <a
                                            href="{{ route('comandas.ticket', [$zona->id, $mesa, Auth::user()->name]) }}">
                                            <x-boton-enviar-comanda></x-boton-enviar-comanda>
                                        </a>
                                    </div>
                                    {{--  <form action="{{ route('comandas.enviar') }}" method="post">
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
                                        <input type="hidden" id="usuario" name="usuario"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <x-boton-enviar-comanda />

                                </form> --}}

                                </div>
                                <div>

                                    <!--Botón Modal Eliminar-->
                                    <x-boton-eliminar data-bs-toggle="modal"
                                        data-bs-target="#modalEliminar" />

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
                                                            <input type="hidden" id="mesa"
                                                                name="mesa"
                                                                value="{{ $mesa }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" id="zona_id"
                                                                name="zona_id"
                                                                value="{{ $zona->id }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" id="familia"
                                                                name="familia"
                                                                value="{{ $familia }}">
                                                        </div>
                                                        <x-boton-eliminar />


                                                    </form>

                                                    @include('components.boton-cancelar')

                                                </div>
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

</aside>

</x-app-layout>
