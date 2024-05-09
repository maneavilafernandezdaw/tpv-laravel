<x-app-layout>

    <nav class="">
        <div class="container flex flex-row justify-between items-center ">
            <a class="" href={{ route('home') }}> <x-boton-inicio></x-boton-inicio></a>
            <h1 class=" h1 hidden m-0 sm:block">PRODUCTOS</h1>
            <h1 class=" h1 block m-0 sm:hidden">PROD.</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->

                    <x-boton-crear name="create_record" id="create_record" />
                    <!-- Button trigger modal Coctel-->

                    <x-boton-coctel name="create_coctel" id="create_coctel" class="coctel"></x-boton-coctel>




                </div>
            </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card rounded-none">



        {{-- Tabla zonas --}}
        <div class="card-body  rounded-none my-3">
            <table id="productos_Datatables" class="table  table-striped table-hover ">
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

                </tbody>
            </table>
        </div>

        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form" class="form-horizontal">
                        <div class="modal-header bg-green-600">
                            <h5 class="modal-title h5 text-white" id="ModalLabel">Agregar</h5>
                            @include('components.boton-cancelar-mini')
                        </div>
                        <div class="modal-body">
                            <span id="gif" class="flex flex-col justify-center items-center">
                                <span id="form_result" class="text-xl fw-semibold text-center text-dark "></span></span>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control rounded-md bg-white text-black" id="nombre"
                                    name="nombre" required maxlength="20">
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="min-w-full  rounded-md bg-white text-black" id="descripcion" name="descripcion" required
                                    aria-label="textarea"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="familia_id">Familia</label>
                                <select class="form-select  bg-white text-black rounded-md"
                                    aria-label="Default select example" id="familia_id" name="familia_id" required>
                                    @foreach ($familias as $familia)
                                        <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio (€)</label>
                                <input type="number" step=".01"
                                    class="form-control rounded-md  bg-white text-black" id="precio" name="precio"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="iva">Iva (%)</label>
                                <input type="number" class="form-control rounded-md bg-white text-black" id="iva"
                                    name="iva" value="21" required>
                            </div>

                            <div class="form-group">
                                <label for="impresora">Impresora</label>
                                <select class="form-select  bg-white text-black rounded-md"
                                    aria-label="Default select example" id="impresora" name="impresora" value="tickets"
                                    required>
                                    @foreach ($impresoras as $impresora)
                                        <option value="{{ $impresora }}">{{ $impresora }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="action" id="action" value="Agregar" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                        <div class="modal-footer">
                            <div id="btncrear" class="show">
                                <x-boton-crear name="action_button" id="action_button" />
                            </div>
                            <div id="btneditar" clas="hidden">
                                <x-boton-editar name="action_button " id="action_button" />
                            </div>
                            @include('components.boton-cancelar')

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Crear Coctel-->
        <div class="modal fade " id="modalCrearCoctel" tabindex="-1" aria-labelledby="modalCrearCoctelLabel"
            aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="coctel_form" class="form-horizontal">
                        <div class="modal-header bg-green-600">
                            <h5 class="modal-title h5 text-white" id="ModalLabel">Agregar</h5>
                            @include('components.boton-cancelar-mini')
                        </div>
                        <div class="modal-body">

                            <div id="gif1" class="flex flex-col justify-center items-center ">

                            </div>
                            <span id="form_result1" class="text-xl fw-semibold text-center text-dark "></span>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control rounded-md bg-white text-black"
                                    id="nombre" name="nombre" maxlength="30" required>
                            </div>


                            <div class="form-group">

                                @foreach ($familias as $familia)
                                    @if ($familia->nombre === 'Cóctel')
                                        <input type="hidden" id="familia_id" name="familia_id"
                                            value="{{ $familia->id }}">
                                    @endif
                                @endforeach

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
                                    id="iva" name="iva" value="21" required>
                            </div>

                            <div class="form-group">
                                <input type="hidden" id="impresora" name="impresora" value="tickets">
                            </div>


                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                        <div class="modal-footer">

                            <x-boton-coctel name="action_button" id="action_button" />


                            @include('components.boton-cancelar')

                    </form>


                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="post" id="sample_form" class="form-horizontal">
                    <div class="modal-header bg-red-600">
                        <h5 class="modal-title  h5 text-white" id="ModalLabel">Eliminar Zona</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <h4 id="aviso" class="text-center m-0">Estás seguro de eliminar la zona?</h4>
                    </div>
                    <div class="modal-footer">



                        <button type="button" name="ok_button" id="ok_button" aria-label="botón eliminar"
                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-4xl px-2.5 py-2.5 text-center me-2 mb-2"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                            </svg></button>
                        @include('components.boton-cancelar')
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        var familias = @json($familias);

        $(document).ready(function() {


            var table = $('#productos_Datatables').DataTable({

                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                "order": [
                    [0, "desc"]
                ],
                "lengthMenu": [5, 10, 20],
                "language": {

                    "lengthMenu": "Mostrar _MENU_ registros por páginas",
                    "zeroRecords": "Nada encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                ajax: "{{ route('productosAjax.index') }}",
                columns: [


                    {
                        data: 'nombre',
                        name: 'nombre',
                        "className": "fw-bold  align-middle"
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        "className": " fw-bold align-middle "
                    },
                    {
                        data: 'familia_id',
                        "render": function(data) {
                            var nombreFamilia = familias.find(function(familia) {
                                return familia.id === data;
                            }).nombre;
                            return nombreFamilia;
                        },
                        "className": " fw-bold  align-middle"
                    },
                    {
                        data: 'precio',
                        name: 'precio',
                        "className": "fw-bold   align-middle"
                    },
                    {
                        data: 'iva',
                        name: 'iva',
                        "className": " fw-bold  align-middle"
                    },

                    {
                        data: 'impresora',
                        name: 'impresora',
                        "className": " fw-bold  align-middle"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        "className": "  align-middle"
                    },

                ]
            });


            $('#create_record').click(function() {
                $('#nombre').val("");
                $('#descripcion').val("");
                $('#precio').val("");
                $('#iva').val("");
                $('#familia_id').val("");
                $('#impresora').val("");

                $('.modal-title').text('Crear Producto');
                $('.modal-header').removeClass('bg-cyan-700');
                $('.modal-header').addClass('bg-green-600');
                $('#btncrear').removeClass('hidden');
                $('#btneditar').addClass('hidden');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#gif').addClass('hidden');
                $('#formModal').modal('show');
                $('.form-group').removeClass('hidden');
                $('.modal-footer').removeClass('hidden');

            });



            $('#sample_form').on('submit', function(event) {
                event.preventDefault();
                var action_url = '';

                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('productosAjax.store') }}";
                }


                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('productosAjax.update') }}";
                }


                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: action_url,
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(data) {
                        console.log('success: ' + data);
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger text-black bg-warning">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success text-black bg-warning">' + data
                                .success + '</div>';
                            $('#sample_form')[0].reset();
                            setTimeout(function() {
                                $('#formModal').modal('hide');
                                $('#productos_Datatables').DataTable().ajax.reload();
                            }, 1500);
                        }
                        $('#form_result').html(html);
                        $('#gif').removeClass('hidden');
                        $('.modal-footer').addClass('hidden');
                        $('.form-group').addClass('hidden');
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });
            $('#create_coctel').click(function() {
                $('#nombre').val("");
                $('#precio').val("");
                $('#iva').val("");
                $('.modal-header').addClass('bg-green-600');
                $('.modal-title').text('Crear Coctel');
                $('#form_result1').html('');
                $('#action').val('Add');
                $('#gif1').addClass('hidden');
                $('#modalCrearCoctel').modal('show');
                $('.form-group').removeClass('hidden');
                $('.modal-footer').removeClass('hidden');


            });
            $('#coctel_form').on('submit', function(event) {
                event.preventDefault();
                var action_url = '';

                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('productosAjax.coctel') }}";
                }



                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: action_url,
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {

                        $('.modal-footer').addClass('hidden');
                        $('.form-group').addClass('hidden');
                        $('#gif1').removeClass('hidden');
                        $('#gif1').html('<img src="imagen/cargando.gif" class=" w-20" alt="Cargando..." /> <span id="form_result1" class="text-xl fw-semibold text-center ">Conectando con OpenAI API para optener la descripción del cóctel</span>' );
                   
                    },
                    success: function(data) {
                        console.log('success: ' + data);
                        var html = '';
                        if (data.errors) {
                            html = '<div class="alert alert-danger bg-warning text-black">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html =
                                '<div class="alert text-black text-xl fw-semibold alert-success bg-warning ">' +
                                data
                                .success + '</div>';
                            $('#coctel_form')[0].reset();
                            setTimeout(function() {
                                $('#modalCrearCoctel').modal('hide');
                                $('#productos_Datatables').DataTable().ajax.reload();
                            }, 1500);
                        }
                        $('#gif1').removeClass('hidden');
                        $('#gif1').html(html);



                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });



            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                var id = $(this).attr('id');

                $('#form_result').html('');
                $('#formModal').modal('show');
                $('.form-group').removeClass('hidden');
                $('.modal-footer').removeClass('hidden');


                $.ajax({
                    url: "productosAjax/edit/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    data: {
                        'id': id,

                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        console.log('success: ' + data);
                        $('#nombre').val(data.result.nombre);
                        $('#descripcion').val(data.result.descripcion);
                        $('#precio').val(data.result.precio);
                        $('#iva').val(data.result.iva);
                        $('#familia_id').val(data.result.familia_id);
                        $('#impresora').val(data.result.impresora);
                        $('#hidden_id').val(id);
                        $('.modal-header').removeClass('bg-green-600');
                        $('.modal-header').addClass('bg-cyan-700');
                        $('.modal-title').text('Editar Producto');
                        $('#btncrear').addClass('hidden');
                        $('#btneditar').removeClass('hidden');
                        $('#action_button').val('Actualizar');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');
                        $('#gif').addClass('hidden');

                        if (data.success) {

                            $('#sample_form')[0].reset();
                            setTimeout(function() {
                                $('#confirmModal').modal('hide');
                                $('#productos_Datatables').DataTable().ajax.reload();
                            }, 1500);

                        }
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                })
            });

            var producto_id;

            $(document).on('click', '.delete', function() {
                producto_id = $(this).attr('id');
                $('#confirmModal').modal('show');
                $('.modal-header').removeClass('bg-cyan-700');
                $('.modal-title').text('Eliminar Producto');
                $('#form_result').html('');
                $('#gif').removeClass('show');
                $('#aviso').html('¿Estás seguro de eliminar este producto?');
                $('.modal-footer').removeClass('hidden');

            });

            $('#ok_button').click(function() {

                $.ajax({
                    type: "post",
                    url: 'productosAjax/destroy/' + producto_id,
                    data: {
                        'id': producto_id,
                        '_token': '{{ csrf_token() }}',
                    },
                    beforeSend: function() {

                        $('.modal-footer').addClass('hidden');

                    },
                    success: function(data) {
                        html =
                            '<div class="alert alert-success text-lg fw-semibold text-black bg-warning">' +
                            data.success +
                            '</div>';
                        $('#aviso').html(html);
                        setTimeout(function() {

                            $('#confirmModal').modal('hide');
                            $('#productos_Datatables').DataTable().ajax.reload();

                        }, 1500);

                    }
                })
            });


        });
    </script>
</x-app-layout>
