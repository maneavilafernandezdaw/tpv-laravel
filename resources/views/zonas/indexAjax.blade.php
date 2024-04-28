<x-app-layout>

    <nav class="">
        <div class="container flex flex-row justify-between items-center ">
            <a class="" href={{ route('home') }}> <x-boton-inicio></x-boton-inicio></a>
            <h1 class=" h1">ZONAS</h1>
            <div class="justify-end ">
                <div class="col ">

                    <!-- Button trigger modal Crear-->

                    <x-boton-crear name="create_record" id="create_record" />



                </div>
            </div>
    </nav>

    {{-- session mensaje  --}}
    @include('partials.session-mensaje')

    <div class="container mt-3 card rounded-none">



        {{-- Tabla zonas --}}
        <div class="card-body  rounded-none my-3">
            <table id="zonas_Datatables" class="table  table-striped table-hover ">
                <thead>
                    <tr>

                        <th>NOMBRE</th>
                        <th>Nº DE MESAS</th>
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
                                <label>Nombre : </label>
                                <input type="text" name="nombre" id="nombre" class="form-control rounded-md"
                                    required />
                            </div>

                            <div class="form-group">
                                <label>Mesas: </label>
                                <input type="number" name="mesas" min="1" id="mesas"
                                    class="form-control rounded-md" required />
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



                            <button type="button" name="ok_button" id="ok_button"
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
    <script>
        function mostrarCargando() {
            // Muestra el indicador de carga
            document.getElementById("loading").style.display = "block";

            // Seleccionar todos los elementos por su clase
            var elementos = document.querySelectorAll('.fade');

            // Iterar sobre todos los elementos seleccionados
            elementos.forEach(function(elemento) {
                // Ejemplo de manipulación de cada elemento seleccionado
                elemento.style.display = 'none';

            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {


            var table = $('#zonas_Datatables').DataTable({

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
                ajax: "{{ route('zonasAjax.index') }}",
                columns: [

                    {
                        data: 'nombre',
                        name: 'nombre',
                        "className": "fw-bold  align-middle"
                    },
                    {
                        data: 'mesas',
                        name: 'mesas',
                        "className": "fw-bold  align-middle"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        "className": "fw-bold  align-middle"
                    },

                ]
            });

            $('#create_record').click(function() {
                $('#nombre').val("");
                $('#mesas').val("");
                $('.modal-title').text('Crear Zona');
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
                    action_url = "{{ route('zonasAjax.store') }}";
                }

                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('zonasAjax.update') }}";
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
                            html = '<div class="alert alert-danger bg-warning">';
                            for (var count = 0; count < data.errors.length; count++) {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if (data.success) {
                            html = '<div class="alert alert-success bg-warning">' + data
                                .success + '</div>';
                            $('#sample_form')[0].reset();
                            setTimeout(function() {
                                $('#formModal').modal('hide');
                                $('#zonas_Datatables').DataTable().ajax.reload();
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

            $(document).on('click', '.edit', function(event) {
                event.preventDefault();
                var id = $(this).attr('id');

                $('#form_result').html('');
                $('#formModal').modal('show');
                $('.modal-footer').removeClass('hidden');
                $('.form-group').removeClass('hidden');


                $.ajax({
                    url: "zonasAjax/edit/" + id,
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
                        $('#mesas').val(data.result.mesas);
                        $('#hidden_id').val(id);
                        $('.modal-header').removeClass('bg-green-600');
                        $('.modal-header').addClass('bg-cyan-700');
                        $('.modal-title').text('Editar Zona');
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
                                $('#zonas_Datatables').DataTable().ajax.reload();
                            }, 1500);

                        }
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                })
            });

            var zona_id;

            $(document).on('click', '.delete', function() {
                zona_id = $(this).attr('id');
                $('#confirmModal').modal('show');
                $('.modal-header').removeClass('bg-cyan-700');
                $('.modal-title').text('Eliminar Zona');
                $('#form_result').html('');
                $('#gif').removeClass('show');
                $('#aviso').html('¿Estás seguro de eliminar la zona?');
                $('.modal-footer').removeClass('hidden');
            });

            $('#ok_button').click(function() {

                $.ajax({
                    type: "post",
                    url: 'zonasAjax/destroy/' + zona_id,
                    data: {
                        'id': zona_id,
                        '_token': '{{ csrf_token() }}',
                    },
                    beforeSend: function() {

                        $('.modal-footer').addClass('hidden');

                    },
                    success: function(data) {
                        html =
                            '<div class="alert alert-success text-lg fw-semibold bg-warning">' +
                            data.success + '</div>';
                        $('#aviso').html(html);
                        setTimeout(function() {

                            $('#confirmModal').modal('hide');
                            $('#zonas_Datatables').DataTable().ajax.reload();

                        }, 1500);

                    }
                })
            });

        });
    </script>
</x-app-layout>
