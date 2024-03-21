<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-2xl" href={{ route('home') }}> <x-boton-inicio /></a>
            <h1 class=" h1">PRODUCTOS</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->

                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrear" />

                    <!-- Modal Crear-->
                    <div class="modal fade " id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Producto</h1>
                                    @include('components.boton-cancelar-mini')
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('productos.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md bg-white text-black"
                                                id="nombre" name="nombre" required maxlength="20">
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea class="min-w-full  rounded-md bg-white text-black" id="descripcion" name="descripcion" required
                                                aria-label="textarea"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="familia_id">Familia</label>
                                            <select class="form-select  bg-white text-black"
                                                aria-label="Default select example" id="familia_id" name="familia_id"
                                                required>
                                                @foreach ($familias as $familia)
                                                    <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="precio">Precio (€)</label>
                                            <input type="number" step=".01"
                                                class="form-control rounded-md  bg-white text-black" id="precio"
                                                name="precio" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="iva">Iva (%)</label>
                                            <input type="number" class="form-control rounded-md bg-white text-black"
                                                id="iva" name="iva" value="21">
                                        </div>

                                        <div class="form-group">
                                            <label for="impresora">Impresora</label>
                                            <select class="form-select  bg-white text-black"
                                                aria-label="Default select example" id="impresora" name="impresora"
                                                required>
                                                @foreach ($impresoras as $impresora)
                                                    <option value="{{ $impresora }}">{{ $impresora }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div>
                                            <img id="imagenSeleccionada" class="max-h-40">
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label for="imagen">Imagen</label>
                                            <input type="file"
                                                class="form-control rounded-md border border-neutral-900 p-2 "
                                                id="imagen" name="imagen">
                                        </div> --}}<br>
                                </div>
                                <div class="modal-footer">
                                    <x-boton-crear />


                                    @include('components.boton-cancelar')

                                    </form>


                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal Coctel-->

                    <x-boton-crear data-bs-toggle="modal" data-bs-target="#modalCrearCoctel" > Cóctel</x-boton-crear>

                    <!-- Modal Crear Coctel-->
                    <div class="modal fade " id="modalCrearCoctel" tabindex="-1" aria-labelledby="modalCrearCoctelLabel"
                        aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header  bg-green-600">
                                    <h1 class="modal-title fs-5 text-white" id="modalCrearLabel">Crear Producto</h1>
                                    @include('components.boton-cancelar-mini')
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('productos.coctel') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control rounded-md bg-white text-black"
                                                id="nombre" name="nombre" required maxlength="20">
                                        </div>

                                   
                                        <div class="form-group">
                                            <label for="familia_id">Familia</label>
                                            <select class="form-select  bg-white text-black"
                                                aria-label="Default select example" id="familia_id" name="familia_id"
                                                required>
                                                @foreach ($familias as $familia)
                                                    <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="precio">Precio (€)</label>
                                            <input type="number" step=".01"
                                                class="form-control rounded-md  bg-white text-black" id="precio"
                                                name="precio" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="iva">Iva (%)</label>
                                            <input type="number" class="form-control rounded-md bg-white text-black"
                                                id="iva" name="iva" value="21">
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" 
                                            id="impresora" name="impresora" value="tickets">
                                        </div>

                                       <br>
                                </div>
                                <div class="modal-footer">
                                    <x-boton-crear />


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

    <div class="container mt-3 card rounded-none">




        <div class="card-body  rounded-none my-3">
            <table id="tabla_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>

                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>FAMILIA</th>
                        <th>PRECIO</th>
                        <th>IVA</th>
                        <th>IMPRESORA</th>
                        {{-- <th>IMAGEN</th> --}}
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
                            <td class="fw-bold text-xl align-middle">{{ $producto->impresora }}</td>
                            {{-- <td class="fw-bold text-xl align-middle">{{ $producto->imagen }}</td> --}}
                            {{--      <td class="fw-bold text-xl align-middle">
                                @if ($producto->imagen)
                                    <img src="imagen/{{ $producto->imagen }}"
                                        class="h-24 w-24 rounded-full  border border-black" alt="imagen producto">
                                @else
                                    Sin Imagen
                                @endif
                            </td> --}}
                            <td class="fw-bold text-xl align-middle">
                                <div class="d-flex justify-end gap-4">
                                    <div>
                                        <!-- Button trigger modal Editar-->

                                        <x-boton-editar data-bs-toggle="modal"
                                            data-bs-target="#modalEditar{{ $producto->id }}" />



                                    </div>
                                    <div>
                                        <!-- Button trigger modal Eliminar-->
                                        <x-boton-eliminar data-bs-toggle="modal"
                                            data-bs-target="#modalEliminar{{ $producto->id }}" />

                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Editar-->
                        <div class="modal fade" id="modalEditar{{ $producto->id }}" tabindex="-1"
                            aria-labelledby="modalEditarLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">

                                    <div class="modal-header bg-blue-600">
                                        <h1 class="modal-title fs-5 text-white" id="modalEditarLabel">
                                            Editar Producto
                                        </h1>
                                        @include('components.boton-cancelar-mini')
                                    </div>
                                    <div class="modal-body">


                                        <form action="{{ route('productos.update', $producto->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text"
                                                    class="form-control rounded-md bg-white text-black" id="nombre"
                                                    name="nombre" required maxlength="30"
                                                    value="{{ $producto->nombre }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <textarea class="min-w-full  rounded-md bg-white text-black" id="descripcion" name="descripcion" required
                                                    aria-label="textarea">{{ $producto->descripcion }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="familia_id">Familia</label>
                                                <select class="form-select  bg-white text-black"
                                                    aria-label="Default select example" id="familia_id"
                                                    name="familia_id" required value="{{ $producto->familia_id }}">
                                                    @foreach ($familias as $familia)
                                                        @if ($familia->id === $producto->familia_id)
                                                            <option value="{{ $familia->id }}" selected>
                                                                {{ $familia->nombre }}</option>
                                                        @else
                                                            <option value="{{ $familia->id }}">
                                                                {{ $familia->nombre }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <input type="number" step=".01"
                                                    class="form-control rounded-md bg-white text-black" id="precio"
                                                    name="precio" required value="{{ $producto->precio }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="iva">Iva</label>
                                                <input type="number"
                                                    class="form-control rounded-md bg-white text-black" id="iva"
                                                    name="iva" value="{{ $producto->iva }}">
                                            </div><br>

                                            <div class="form-group">
                                                <label for="impresora">Impresora</label>
                                                <select class="form-select bg-white text-black"
                                                    aria-label="Default select example" id="impresora"
                                                    name="impresora" required value="{{ $producto->impresora }}">
                                                    @foreach ($impresoras as $impresora)
                                                        @if ($impresora === $producto->impresora)
                                                            <option value="{{ $impresora }}" selected>
                                                                {{ $impresora }}</option>
                                                        @else
                                                            <option value="{{ $impresora }}">
                                                                {{ $impresora }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div><br>

                                            {{-- <div class="form-group">
                                                                                        <label for="imagen">Imagen</label>
                                                                                        <input type="file"
                                                                                            class="form-control rounded-md border border-neutral-900 p-2 "
                                                                                            id="imagen" name="imagen">
                                                                                            @if ($producto->imagen)
                                                                                            <img src="imagen/{{ $producto->imagen }}"
                                                                                                class="h-24 w-24 rounded-full  border border-black" alt="imagen producto">
                                                                                     
                                                                                        @endif
                                                                                    </div><br> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <x-boton-editar />


                                        @include('components.boton-cancelar')

                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Modal Eliminar-->
                        <div class="modal fade" id="modalEliminar{{ $producto->id }}" tabindex="-1"
                            aria-labelledby="modalEliminarLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header  bg-red-600">
                                        <h1 class="modal-title fs-5 text-white">Eliminar Producto
                                        </h1>
                                        @include('components.boton-cancelar-mini')
                                    </div>
                                    <div class="modal-body text-center">
                                        <div>
                                            <p class="">¿Está seguro que desea eliminar el
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

                                            <x-boton-eliminar />


                                        </form>

                                        @include('components.boton-cancelar')

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
