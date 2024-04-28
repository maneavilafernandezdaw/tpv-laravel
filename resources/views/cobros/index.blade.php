<x-app-layout>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand text-2xl" href={{ route('home') }}> <x-boton-inicio /></a>
            <h1 class="h1">Cobros</h1>
            <div>
                <a href="{{ route('cajas.store') }}"><x-boton-cerrarCaja /></a>

            </div>
        </div>
    </nav>

    <div class="container mt-3 card rounded-none">
        <div class="card-body  rounded-none my-3">

            <h1 class=" h1">Total: {{ $total }}€</h1>

            {{-- Tabla Cobros --}}
            <table id="cobros_Datatables" class="table  table-striped table-hover ">
                <thead>

                    <tr>
                        <th>ID</th>
                        <th>ZONA</th>
                        <th>MESA</th>
                        <th>CANTIDAD</th>
                        <th>TIPO</th>
                        <th>Fecha/Hora</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
      
    <script type="text/javascript">
        var zonas = @json($zonas);


        $(document).ready(function() {


            var table = $('#cobros_Datatables').DataTable({

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
                ajax: "{{ route('cobros.index') }}",
                "columnDefs": [{
            "targets": 5, // Índice de la columna 'created_at' (0-indexado)
            "render": function(data) {
                // Formatear la fecha
                var created_at = new Date(data);
                return created_at.toLocaleString(); // Puedes ajustar el formato según tus necesidades
            }
        }],
        
                columns: [

                    {
                        data: 'id',
                        name: 'id',
                        "className": "fw-bold  align-middle"
                    },
 
                    {
                        data: 'zona_id',
                        name: 'zona_id',
                        "render": function(data) {
                            var nombreZona = zonas.find(function(zona) {
                                return zona.id === data;
                            }).nombre;
                            return nombreZona;
                        },
                        "className": "fw-bold  align-middle"
                    },
                    {
                        data: 'mesa',
                        name: 'mesa',
                        "className": " fw-bold align-middle "
                    },

                    {
                        data: 'cantidad',
                        name: 'cantidad',
                        "className": "fw-bold   align-middle"
                    },
                    {
                        data: 'tipo',
                        name: 'tipo',
                        "className": " fw-bold  align-middle"
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        "className": " fw-bold  align-middle"

                    },
                ],


            });

        });
    </script>
</x-app-layout>
