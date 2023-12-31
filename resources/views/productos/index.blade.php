<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light bg-gray-800">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl text-white" href={{ route('home') }}>Inicio</a>
            <h1 class="text-white h1">Productos</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->

                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrear">
                        {{ __('Nuevo') }}
                    </x-boton-crear>
                    <!-- Modal Crear-->
                    <div class="modal fade " id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Zona</h1>

                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('productos.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md" id="nombre"
                                                name="nombre" required maxlength="30">
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea class="min-w-full  rounded-md" id="descripcion" name="descripcion" required aria-label="textarea"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="familia_id">Familia</label>
                                            <select class="form-select" aria-label="Default select example"
                                                id="familia_id" name="familia_id" required>
                                                @foreach ($familias as $familia)
                                                    <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="number" step=".01" class="form-control rounded-md"
                                                id="precio" name="precio" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="iva">Iva</label>
                                            <input type="number" class="form-control rounded-md" id="iva"
                                                name="iva" value="21">
                                        </div>
                                        <div>
                                            <img id="imagenSeleccionada" class="max-h-40">
                                        </div>

                                        <div class="form-group">
                                            <label for="imagen">Imagen</label>
                                            <input type="file"
                                                class="form-control rounded-md border border-neutral-900 p-2 "
                                                id="imagen" name="imagen">
                                        </div><br>

                                        <x-boton-crear>
                                            {{ __('Aceptar') }}
                                        </x-boton-crear>

                                        @include('components.boton-cancelar')

                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card bg-gray-700 rounded-none">




        <div class="card-body bg-gray-300 rounded-none my-3">
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>

                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>FAMILIA</th>
                        <th>PRECIO</th>
                        <th>IVA</th>
                        <th>IMAGEN</th>
                        <th></th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>

                            <td class="fw-bold text-xl align-middle">{{ $producto->nombre }}</td>
                            <td class="fw-bold text-xl align-middle">{{ $producto->descripcion }}</td>
                            <td class="fw-bold text-xl align-middle">
                                @foreach ($familias as $familia)
                                    @if ($familia->id === $producto->familia_id)
                                        {{ $familia->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="fw-bold text-xl align-middle">{{ $producto->precio }}€</td>
                            <td class="fw-bold text-xl align-middle">{{ $producto->iva }}%</td>
                            {{-- <td class="fw-bold text-xl align-middle">{{ $producto->imagen }}</td> --}}
                            <td class="fw-bold text-xl align-middle">
                                @if ($producto->imagen)
                                    <img src="imagen/{{ $producto->imagen }}"
                                        class="h-24 w-24 rounded-full  border border-black" alt="imagen producto">
                                @else
                                    Sin Imagen
                                @endif
                            </td>
                            <td class="fw-bold text-xl align-middle">
                                <div class="d-flex justify-end gap-4">
                                    <div>
                                        <!-- Button trigger modal Editar-->

                                        <x-boton-editar data-bs-toggle="modal"
                                            data-bs-target="#modalEditar{{ $producto->id }}">
                                            {{ __('Editar') }}
                                        </x-boton-editar>
                                        <!-- Modal Editar-->
                                        <div class="modal fade" id="modalEditar{{ $producto->id }}" tabindex="-1"
                                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">

                                                    <div class="modal-header bg-blue-600">
                                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                                            Editar Producto
                                                        </h1>

                                                    </div>
                                                    <div class="modal-body">


                                                        <form action="{{ route('productos.update', $producto->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="nombre">Nombre</label>
                                                                <input type="text" class="form-control rounded-md"
                                                                    id="nombre" name="nombre" required
                                                                    maxlength="30" value="{{ $producto->nombre }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="descripcion">Descripción</label>
                                                                <textarea class="min-w-full  rounded-md" id="descripcion" name="descripcion" required aria-label="textarea">{{ $producto->descripcion }}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="familia_id">Familia</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example"
                                                                    id="familia_id" name="familia_id" required
                                                                    value="{{ $producto->familia_id }}">
                                                                    @foreach ($familias as $familia)
                                                                        <option value="{{ $familia->id }}">
                                                                            {{ $familia->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="precio">Precio</label>
                                                                <input type="number" step=".01"
                                                                    class="form-control rounded-md" id="precio"
                                                                    name="precio" required
                                                                    value="{{ $producto->precio }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="iva">Iva</label>
                                                                <input type="number" class="form-control rounded-md"
                                                                    id="iva" name="iva"
                                                                    value="{{ $producto->iva }}">
                                                            </div>
                                                            <div>
                                                                <img src="imagen/{{ $producto->imagen }}"
                                                                    id="imagenSeleccionada" class="max-h-40">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="imagen">Imagen</label>
                                                                <input type="file"
                                                                    class="form-control rounded-md border border-neutral-900 p-2 "
                                                                    id="imagen" name="imagen">
                                                            </div><br>

                                                            <x-boton-editar>
                                                                {{ __('Aceptar') }}
                                                            </x-boton-editar>

                                                            @include('components.boton-cancelar')

                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar{{ $producto->id }}">
                                            {{ __('Eliminar') }}
                                        </x-boton-eliminar>
                                        <!-- Modal Eliminar-->
                                        <div class="modal fade" id="modalEliminar{{ $producto->id }}" tabindex="-1"
                                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                                            <div class="modal-dialog text-black">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-red-600">
                                                        <h1 class="modal-title fs-5 text-white">Eliminar Producto
                                                        </h1>

                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div>
                                                            <p class="text-black">¿Está seguro que desea eliminar el
                                                                producto: {{ $producto->nombre }} ?</p>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('productos.destroy', $producto->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="idproducto" id="idproducto"
                                                                value="{{ $producto->id }}">

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
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
