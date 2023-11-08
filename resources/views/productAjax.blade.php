{{-- <!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body> --}}

<x-app-layout>

    <div class="container">
        <h1>Laravel Ajax CRUD Tutorial Example - ItSolutionStuff.com</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
        <table class="table table-bordered data-table" id="tabla_Datatables">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCIÓN</th>
                    <th>FAMILIA</th>
                    <th>PRECIO</th>
                    <th>IVA</th>
                    <th>IMAGEN</th>

                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $producto)
                <tr>
                    <td class="fw-bold text-xl align-middle">{{ $producto->id }}</td>
                    <td class="fw-bold text-xl align-middle">{{ $producto->nombre }}</td>
                    <td class="fw-bold text-xl align-middle">{{ $producto->descripcion }}</td>
                    <td class="fw-bold text-xl align-middle">{{ $producto->familia_id }}</td>
                    <td class="fw-bold text-xl align-middle">{{ $producto->precio }}€</td>
                    <td class="fw-bold text-xl align-middle">{{ $producto->iva }}%</td>
                      {{-- <td class="fw-bold text-xl align-middle">{{ $producto->imagen }}</td> --}}
                    <td class="fw-bold text-xl align-middle">
                        @if($producto->imagen)
                        <img src="imagen/{{ $producto->imagen }}" class="h-24 w-24 rounded-full  border border-black" alt="imagen producto">
                        @else
                        Sin Imagen
                        @endif
                    </td>
                    <td class="fw-bold text-xl align-middle">
                        <div class="d-flex justify-center gap-4">
                            <div>
                                <!-- Button trigger modal Editar-->

                                <x-boton-editar href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit">
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
                                                    <input type="text" class="form-control rounded-md" id="nombre"
                                                        name="nombre" required maxlength="30"  value="{{ $producto->nombre }}">
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="descripcion">Descripción</label>
                                                    <textarea class="min-w-full  rounded-md" id="descripcion" name="descripcion" required aria-label="textarea" >{{ $producto->descripcion }}</textarea>
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="familia_id">Familia</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="familia_id" name="familia_id" required value="{{ $producto->familia_id }}">
                                                        @foreach ($familias as $familia)
                                                            <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="precio">Precio</label>
                                                    <input type="number" step=".01" class="form-control rounded-md"
                                                        id="precio" name="precio" required value="{{ $producto->precio }}">
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="iva">Iva</label>
                                                    <input type="number" class="form-control rounded-md" id="iva"
                                                        name="iva" value="{{ $producto->iva }}">
                                                </div>
                                                <div>
                                                    <img src="imagen/{{ $producto->imagen }}" id="imagenSeleccionada" class="max-h-40">
                                                </div>
        
                                                <div class="form-group">
                                                    <label for="imagen">Imagen</label>
                                                    <input type="file" class="form-control rounded-md border border-neutral-900 p-2 " id="imagen"
                                                        name="imagen" >
                                                </div><br>
        
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

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">


                    <form enctype="multipart/form-data" id="productForm" name="productForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control rounded-md" id="nombre" name="nombre" required
                                maxlength="30">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="min-w-full  rounded-md" id="descripcion" name="descripcion" required aria-label="textarea"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="familia_id">Familia</label>
                            <select class="form-select" aria-label="Default select example" id="familia_id"
                                name="familia_id" required>
                                @foreach ($familias as $familia)
                                    <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" step=".01" class="form-control rounded-md" id="precio"
                                name="precio" required>
                        </div>

                        <div class="form-group">
                            <label for="iva">Iva</label>
                            <input type="number" class="form-control rounded-md" id="iva" name="iva"
                                value="21">
                        </div>
                        <div>
                            <img id="imagenSeleccionada" class="max-h-40">
                        </div>

                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control rounded-md border border-neutral-900 p-2 "
                                id="imagen" name="imagen">
                        </div><br>

                        <x-boton-crear>
                            {{ __('Aceptar') }}
                        </x-boton-crear>

                        @include('components.boton-cancelar')

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    </body>

    <script type="text/javascript">

        $(function() {

            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products-ajax-crud.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'familia_id',
                        name: 'familia_id'
                    },
                    {
                        data: 'precio',
                        name: 'precio'
                    },
                    {
                        data: 'iva',
                        name: 'iva'
                    },
                    {
                        data: 'imagen',
                        name: 'imagen'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Button
            --------------------------------------------
            --------------------------------------------*/
            $('#createNewProduct').click(function() {
                $('#saveBtn').val("create-product");
                $('#id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editProduct', function() {
                var id = $(this).data('id');
                $.get("{{ route('products-ajax-crud.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit Product");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#id').val(data.id);
                    $('#nombre').val(data.nombre);
                    $('#descripcion').val(data.descripcion);
                    $('#familia_id').val(data.familia_id);
                    $('#precio').val(data.precio);
                    $('#iva').val(data.iva);
                    $('#imagen').val(data.imagen);
                })
            });

            /*------------------------------------------
            --------------------------------------------
            Create Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('products-ajax-crud.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            /*------------------------------------------
            --------------------------------------------
            Delete Product Code
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.deleteProduct', function() {

                var id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('products-ajax-crud.store') }}" + '/' + id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

        });
    </script>
</x-app-layout>
{{-- </html> --}}
